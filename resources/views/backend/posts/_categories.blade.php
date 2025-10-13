<ul style="list-style: none;">
    @foreach($categories as $category)
        <li>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" {{ in_array($category->id, $selected) ? 'checked' : null }} class="custom-control-input" id="c_{{ $category->id }}" value="{{ $category->id }}" name="categories[]">
                <label class="custom-control-label" for="c_{{ $category->id }}">{{ $category->name }}</label>
            </div>
        </li>   
        @if ($category->children->isNotEmpty())
            @include('backend.posts._categories', ['categories' => $category->children])
        @endif
        
    @endforeach
</ul>