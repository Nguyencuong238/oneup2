<x-app-layout>
    <form action="{{ route('organizations.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Tạo tổ chức') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Name') }}:</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Logo') }}:</label>
                            @php
                                $organization = new \App\Models\Organization();
                            @endphp
                            <x-media-library-collection name="media" :model="$organization" collection="media"
                                rules="mimes:png,jpeg,jpg,webp" max-items="1" />
                        </div>

                        <div class="form-group">
                            <label>Website:</label>
                            <input type="text" name="website" value="{{ old('website') }}"
                                class="form-control @error('website') is-invalid @enderror" placeholder="">
                            @error('website')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Lĩnh vực:</label>
                            <input type="text" name="industry" value="{{ old('industry') }}"
                                class="form-control @error('industry') is-invalid @enderror" placeholder="">
                            @error('industry')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Quy mô:</label>
                            <div class="custom-control">
                                <input type="radio" id="size-1-10" name="size"
                                    {{ old('size') == '1-10' ? 'checked' : null }} value="1-10">
                                <label for="size-1-10">1-10</label>

                                <input type="radio" id="size-11-50" name="size" class="ml-2"
                                    {{ old('size') == '11-50' ? 'checked' : null }} value="11-50">
                                <label for="size-11-50">11-50</label>

                                <input type="radio" id="size-51-200" name="size" class="ml-2"
                                    {{ old('size') == '51-200' ? 'checked' : null }} value="51-200">
                                <label for="size-51-200">51-200</label>

                                <input type="radio" id="size-201-500" name="size" class="ml-2"
                                    {{ old('size') == '201-500' ? 'checked' : null }} value="201-500">
                                <label for="size-201-500">201-500</label>

                                <input type="radio" id="size-500+" name="size" class="ml-2"
                                    {{ old('size') == '500+' ? 'checked' : null }} value="500+">
                                <label for="size-500+">500+</label>

                            </div>
                            @error('size')
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
                            <button type="submit" class="btn btn-success"><i
                                    class="icon-paperplane mr-2"></i>{{ __('Save') }} </button>
                            <a href="{{ route('organizations.index') }}" class="btn btn btn-light ml-2"><i
                                    class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
    @endpush
</x-app-layout>
