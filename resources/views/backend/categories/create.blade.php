<x-app-layout>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Create Category') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Category') }}:</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name')is-invalid @enderror" placeholder="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Parent') }}:</label>
                            <select name="parent_id" data-placeholder="{{ __('Select category parent') }}"
                                class="form-control form-control-select2 @error('type')is-invalid @enderror" data-fouc>
                                <option {{ old('parent_id') == 'root' ? 'selected' : null }} value="root">
                                    {{ __('- Root Level') }}</option>
                                @foreach ($parentCategories as $pc)
                                    <option {{ old('parent_id') == $pc->id ? 'selected' : null }}
                                        value="{{ $pc->id }}">{!! $pc->selectText() !!}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Type') }}:</label>
                            <select name="type" data-placeholder="{{ __('Select category type') }}"
                                class="form-control form-control-select2 @error('type')is-invalid @enderror" data-fouc>
                                <option></option>
                                <option {{ old('type') == 'post' ? 'selected' : null }} value="post">
                                    {{ __('Post') }}</option>
                                <option {{ old('type') == 'kols' ? 'selected' : null }} value="kols">
                                    {{ __('KOLs') }}</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="d-flex mb-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="external_link" {{ old('external_link') == '1' ? 'checked' : null }} id="external_link" value="1">
                                <label class="custom-control-label" for="external_link">{{ __('External link') }}?</label>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group link" @if (!old('external_link')) style="display: none; @endif">
                            <label>{{ __('Link') }}:</label>
                            <input type="text" name="link" value="{{ old('link') }}" class="form-control">
                        </div> --}}
                    </div>
                    {{-- @include('backend.posts._meta', ['model' => new \App\Models\Category]) --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="sidebar-section-header">
                        <span class="font-weight-semibold">{{ __('Publish') }}</span>
                        <div class="list-icons ml-auto">
                            <a href="#publish" class="list-icons-item" data-toggle="collapse" aria-expanded="true">
                                <i class="icon-arrow-down12"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show" id="publish">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success"><i
                                    class="icon-paperplane mr-2"></i>{{ __('Save') }} </button>
                            <a href="{{ route('categories.index') }}" class="btn btn btn-light ml-2"><i
                                    class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
            <script>
            $('[name=external_link]').on('change', function() {
                var is_checked = $(this).is(':checked');
                if (is_checked) {
                    $('.link').show();
                } else {
                    $('.link').hide();
                }
            });
        </script>
    @endpush
</x-app-layout>
