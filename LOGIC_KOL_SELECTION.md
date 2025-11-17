# KOL Selection Logic - Campaign Planner

## Overview
The KOL (creator) selection system uses client-side JavaScript Map for fast selection tracking and AJAX for server-side pagination and filtering.

---

## Backend Logic (PHP - BrandController)

### Method: `ajaxFilter(Request $req)`
**Location:** `app/Http/Controllers/Front/Dashboard/BrandController.php`

**Functionality:**
1. **Query Building**: Filters KOLs based on 3 criteria:
   - `category`: Filter by KOL category
   - `price`: Filter by campaign price range (low < 1M, medium 1-5M, high > 5M)
   - `eng`: Filter by engagement rate (low < 1%, medium 1-5%, high > 5%)

2. **Pagination**: 
   - **Per page**: 10 KOLs
   - **Current page**: From request parameter `page` (default 1)
   - Uses Laravel `paginate()` method

3. **Response Format**:
```json
{
  "html": "<rendered-grid-html>",
  "pagination": "<pagination-buttons>",
  "total": 156,
  "has_more": true
}
```

4. **Selected Fields**: `id`, `display_name`, `followers`, `engagement`, `price_campaign`

---

## Frontend Logic (JavaScript - jQuery)

### Data Structure
```javascript
let selectedKOLs = new Map()  // id => {name, followers, price, avatar}
let currentFilter = ''        // Tracks active filter
```

### Key Functions

#### 1. `loadKols(page = 1)`
**Purpose**: Load KOL grid with current filter and pagination

**Steps**:
- Makes AJAX request to `/kols/ajax-filter` with:
  - `filter`: Current filter value
  - `page`: Current page number
- On success:
  - Renders KOL grid HTML
  - Renders pagination buttons
  - Restores checkbox states from `selectedKOLs` Map
  - **Key**: Updates selections without losing them on pagination

#### 2. `getKolInfo($card)`
**Purpose**: Extract KOL data from DOM card element

**Returns**:
```javascript
{
  name: string,        // display_name
  followers: string,   // formatted followers count
  price: string,       // formatted price (₫...)
  avatar: string       // HTML img element
}
```

#### 3. `updateSelectedKOLs()`
**Purpose**: Update preview panel with selected creators

**Logic**:
- Counts selected KOLs
- Calculates average cost per KOL
- Renders selected list with remove buttons
- Updates header and stats

#### 4. `initSelectedFromDOM()`
**Purpose**: Initialize selected KOLs from pre-checked checkboxes

**Used at**: Page load to restore previously selected KOLs

---

## Event Handlers

### 1. Filter Change
```javascript
$doc.on('change', '#kol-filter', function() {
    currentFilter = $(this).val();
    loadKols(1);  // Always start from page 1
});
```

### 2. KOL Card Click
```javascript
$doc.on('click', '#kol-grid .kol-select-card', function(e) {
    if ($(e.target).is('.kol-checkbox')) return;  // Let checkbox handle itself
    // Toggle checkbox
    $(this).find('.kol-checkbox').prop('checked', !...)
        .trigger('change');
});
```

### 3. Checkbox Change
```javascript
$doc.on('change', '#kol-grid .kol-checkbox', function() {
    const $card = $(this).closest('.kol-select-card');
    const id = String($card.data('id'));
    
    if ($(this).is(':checked')) {
        selectedKOLs.set(id, getKolInfo($card));  // Add to Map
        $card.addClass('selected');
    } else {
        selectedKOLs.delete(id);                   // Remove from Map
        $card.removeClass('selected');
    }
    updateSelectedKOLs();  // Refresh preview
});
```

### 4. Remove from Preview
```javascript
$doc.on('click', '.remove-selected-kol', function() {
    const id = String($(this).data('id'));
    selectedKOLs.delete(id);
    $(`[data-id="${id}"]`).removeClass('selected')
        .find('.kol-checkbox').prop('checked', false);
    updateSelectedKOLs();
});
```

### 5. Pagination
```javascript
$doc.on('click', '.kol-prev-page, .kol-next-page, .kol-goto-page', function() {
    const page = $(this).data('page');
    loadKols(page);  // Load new page without losing selections
    window.scrollTo(0, $kolGrid.offset().top - 100);
});
```

---

## Data Flow Diagram

```
User Action
    ↓
Event Handler
    ↓
Update selectedKOLs Map (client-side cache)
    ↓
updateSelectedKOLs() → Update preview panel
    ↓
Submit Form
    ↓
campaignStore() saves selectedKOLs to DB via hidden inputs
```

---

## Key Advantages

1. **Fast Selection**: Map for O(1) lookups
2. **Persistent Selection**: Survives pagination/filtering
3. **Efficient Pagination**: Only 10 KOLs per page
4. **Smart Filtering**: Multiple criteria support
5. **Visual Feedback**: Selected state styling on cards
6. **Resilient**: Restores selections after AJAX reload

---

## Form Submission

When user clicks "Save" or "Draft":

```javascript
selectedKOLs.forEach((info, id) => {
    $form.append(`<input type="hidden" name="kols[]" value="${id}">`);
});
```

All selected KOL IDs are added as hidden inputs to form, then:
```php
// In campaignStore():
$campaign->kols()->sync($request->kols);  // Save to DB
```

---

## Notes

- **Checkbox state** is tied to DOM, but **selection tracking** is in Map
- Map is the single source of truth for selections
- DOM can change (pagination), but Map persists
- All selected KOL IDs sent to server in form submission
