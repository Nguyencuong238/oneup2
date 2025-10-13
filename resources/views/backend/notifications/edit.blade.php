<x-app-layout>
    <form action="{{ route('notifications.update', $notification) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Chỉnh sửa thông báo') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Title') }}:</label>
                            <input type="text" name="title" value="{{ old('title', $notification->title) }}" class="form-control @error('title')is-invalid @enderror" placeholder="">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Đường dẫn') }}:</label>
                            <input type="text" name="link" value="{{ old('link', $notification->link) }}" class="form-control @error('link')is-invalid @enderror" placeholder="">
                            @error('link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="custom-control custom-checkbox mb-2">
                            <input type="hidden" class="custom-control-input" name="status" value="0">
                            <input type="checkbox" class="custom-control-input" name="status" {{ old('status', $notification->status) == '1' ? 'checked' : null }} value="1" id="status">
                            <label class="custom-control-label" for="status">{{ __('Hiển thị') }}</label>
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ __('Save') }} </button>
                            <a href="{{ route('notifications.index') }}" class="btn btn btn-light ml-2"><i class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@push('js')
@endpush
</x-app-layout>
