<select name="language" data-placeholder="{{ __('Chọn danh mục') }}"
    class="form-control form-control-select2 @error('language')is-invalid @enderror">
    <option></option>
    @foreach($categories as $category)
    <option {{ old('language') == $category->name ? 'selected' : null }} value="{{ $category->name }}">
        {{ $category->name }}</option>
    @endforeach
</select>