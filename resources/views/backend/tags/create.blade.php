<x-app-layout>
    <form action="{{ route('tags.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Create Tag') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Tag') }}:</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')is-invalid @enderror" placeholder="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Type') }}:</label>
                            <select name="type" data-placeholder="{{ __('Select tag type') }}" class="form-control form-control-select2 @error('type')is-invalid @enderror" data-fouc>
                                <option></option>
                                <option {{ old('type') == 'post' ? 'selected' : null }} value="post">{{ __('Post') }}</option>
                                {{-- <option {{ old('type') == 'page' ? 'selected' : null }} value="page">{{ __('Page') }}</option> --}}
                                {{-- <option {{ old('type') == 'event' ? 'selected' : null }} value="event">{{ __('Event') }}</option> --}}
                                <option {{ old('type') == 'project' ? 'selected' : null }} value="project">{{ __('Project') }}</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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
                            <a href="{{ route('tags.index') }}" class="btn btn btn-light ml-2"><i class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

        
</x-app-layout>