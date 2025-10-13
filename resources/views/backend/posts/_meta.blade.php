<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">{{ __('Search Engine Optimize') }}</h5>
        </div>
    </div>
    <div class="card-body">
        <ul class="media-list mb-3" id="seo_preview">
            <li class="media">
                <div class="media-body">
                    <h6 class="media-title"><a href="#" id="seo_title_text">{{ old('meta_title', $model->meta['meta_title'] ?? null) }}</a></h6>
                    <ul class="list-inline list-inline-dotted text-muted mb-2">
                        <li class="list-inline-item"><a href="#" class="text-success">{{ config('app.url') }}</a></li>
                    </ul>

                    <span id="seo_description_text">{{ old('meta_description', $model->meta['meta_description'] ?? null) }}</span>
                </div>
            </li>
        </ul>

        <div class="form-group">
            <label>{{ __('Đường dẫn') }}:</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $model->slug ?? null) }}" class="form-control @error('slug')is-invalid @enderror">
            @error('slug')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>{{ __('Seo Title') }}:</label>
            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $model->meta['meta_title'] ?? null) }}" class="form-control @error('meta_title')is-invalid @enderror" placeholder="{{ __('Add seo title') }}">
            @error('meta_title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Seo Description') }}:</label>
            <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description')is-invalid @enderror" placeholder="{{ __('Add seo description') }}">{{ old('meta_description', $model->meta['meta_description'] ?? null) }}</textarea>
            @error('meta_description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function() {
            var $metaTitle = $('#meta_title');
            var $metaDescription = $('#meta_description');
            var $seoPreview = $('#seo_preview');
            var $seoTitleText = $('#seo_title_text');
            var $seoDescriptionText = $("#seo_description_text")

            $metaTitle.on('keyup', function() {
                var metaTitle = $metaTitle.val();
                var metaDescription = $metaDescription.val();

                if (metaTitle == '' && metaDescription == '') {
                    $seoPreview.hide();
                } else {
                    $seoPreview.show();
                    $seoTitleText.text(metaTitle);
                    $seoDescriptionText.text(metaDescription);
                }
            });

            $metaDescription.on('keyup', function() {
                var metaDescription = $metaDescription.val();
                var metaTitle = $metaTitle.val();

                if (metaTitle == '' && metaDescription == '') {
                    $seoPreview.hide();
                } else {
                    $seoPreview.show();
                    $seoTitleText.text(metaTitle);
                    $seoDescriptionText.text(metaDescription);
                }
            });
        });
    </script>
@endpush