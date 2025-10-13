<x-app-layout>
<div class="row">
    <div class="col-sm-3">
    <div class="sidebar sidebar-light sidebar-component position-static w-100 d-block mb-lg-4">
        <div class="sidebar-content position-static">

            <!-- Navigation -->
            <div class="sidebar-section">
                <ul class="nav nav-sidebar" data-nav-type="collapsible">
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-sm line-height-sm">Settings</div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('setting.home') }}" class="nav-link active">
                            <i class="icon-puzzle4"></i>
                            Home
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /navigation -->

        </div>
    </div>
    </div>

    <div class="col-sm-9">
        <form action="{{ route('setting.home.save') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    {{-- <div class="form-group">
                        <label>{{ __('Menu Category') }}:</label>
                        <select id="menu-category" multiple name="menu_category_id[]" data-placeholder="{{ __('Select category') }}" class="form-control w-md-50 @error('type')is-invalid @enderror" data-fouc>
                            @foreach($categories as $pc)
                                <option {{ in_array($pc->id, old('menu_category_id', settings('menu_category_id', []))) ? 'selected' : null }} value="{{ $pc->id }}">{!! $pc->selectText() !!}</option>
                            @endforeach
                        </select>
                        @error('menu_category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label>{{ __('Phone') }}:</label>
                        <input type="text" name="phone" value="{{ old('phone', settings('phone')) }}" class="form-control @error('phone')is-invalid @enderror" placeholder="">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Email') }}:</label>
                        <input type="text" name="contact_email" value="{{ old('contact_email', settings('contact_email')) }}" class="form-control @error('contact_email')is-invalid @enderror" placeholder="abc@gmail.com">
                        @error('contact_email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Tiktok') }}:</label>
                        <input type="text" name="tiktok" value="{{ old('tiktok', settings('tiktok')) }}" class="form-control @error('tiktok')is-invalid @enderror" placeholder="">
                        @error('tiktok')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Facebook') }}:</label>
                        <input type="text" name="facebook" value="{{ old('facebook', settings('facebook')) }}" class="form-control @error('facebook')is-invalid @enderror" placeholder="">
                        @error('facebook')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Twitter') }}:</label>
                        <input type="text" name="twitter" value="{{ old('twitter', settings('twitter')) }}" class="form-control @error('twitter')is-invalid @enderror" placeholder="">
                        @error('twitter')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>{{ __('Telegram') }}:</label>
                        <input type="text" name="telegram" value="{{ old('telegram', settings('telegram')) }}" class="form-control @error('telegram')is-invalid @enderror" placeholder="">
                        @error('telegram')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Youtube') }}:</label>
                        <input type="text" name="youtube" value="{{ old('youtube', settings('youtube')) }}" class="form-control @error('youtube')is-invalid @enderror" placeholder="">
                        @error('youtube')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('js')
    <script>
        $(function() {
            $('#menu-category').select2().on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        })
    </script>
@endpush
</x-app-layout>