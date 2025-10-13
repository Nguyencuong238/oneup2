<x-app-layout>
    <form action="{{ route('posts.update', $post) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Edit Post') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Title') }}:</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control @error('title')is-invalid @enderror" placeholder="Add title">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Excerpt') }}:</label>
                            <textarea name="excerpt" class="form-control @error('excerpt')is-invalid @enderror" placeholder="Add excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Image') }}:</label>
                            <x-media-library-collection
                                name="media"
                                :model="$post"
                                collection="media"
                                rules="mimes:png,jpeg,pdf"
                                max-items="1"
                            />
                        </div>                        
                        <div class="d-flex mb-2">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="hidden" class="custom-control-input" name="is_featured" value="0">
                                <input type="checkbox" class="custom-control-input" name="is_featured" {{ old('is_featured', $post->is_featured) == '1' ? 'checked' : null }} value="1" id="is_featured">
                                <label class="custom-control-label" for="is_featured">{{ __('Is featured ?') }}</label>
                            </div>
                            {{--  ut1  --}}
                            <div class="custom-control ml-3">
                                <input type="radio" name="order" {{ $post->order == '1' ? 'checked' : null }} value="1" id="ut1">
                                <label for="ut1">{{ __('UT1') }}</label>
                            </div>
                            {{--  ut2  --}}
                            <div class="custom-control  ml-3">
                                <input type="radio" name="order" {{ $post->order == '2' ? 'checked' : null }} value="2" id="ut2">
                                <label for="ut2">{{ __('UT2') }}</label>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="hidden" class="custom-control-input" name="is_new" value="0">
                                <input type="checkbox" class="custom-control-input" name="is_new" {{ old('is_new', $post->is_new) == '1' ? 'checked' : null }} value="1" id="is_new">
                                <label class="custom-control-label" for="is_new">{{ __('Is new ?') }}</label>
                            </div>
                            {{--  ut3  --}}
                            <div class="custom-control ml-3">
                                <input type="radio" name="order" {{ $post->order == '3' ? 'checked' : null }} value="3" id="ut3">
                                <label for="ut3">{{ __('UT3') }}</label>
                            </div>
                            {{--  ut4  --}}
                            <div class="custom-control  ml-3">
                                <input type="radio" name="order" {{ $post->order == '4' ? 'checked' : null }} value="4" id="ut4">
                                <label for="ut4">{{ __('UT4') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Content') }}:</label>
                            <textarea name="body" class="editor form-control @error('body')is-invalid @enderror" placeholder="Add content">{{ old('body', $post->body) }}</textarea>
                            @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Relate Projects') }}</label>
                            <select multiple="multiple" class="form-control" id="select-projects" data-fouc name="projects[]">
                                @foreach(old('projects', $post->projects()->pluck('id')->toArray()) as $projectId)
                                    <option value="{{ $projectId }}" selected></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @include('backend.posts._meta', ['model' => $post])
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
                            <a href="{{ route('posts.index') }}" class="btn btn btn-light ml-2"><i class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                            <a href="{{ $post->showUrl() }}" target="_blank" class="btn btn btn-primary ml-2">
                                <i class="icon-eye mr-2"></i>{{ __('View') }} </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="sidebar-section-header">
                        <span class="font-weight-semibold">{{ __('Categories') }}</span>
                        <div class="list-icons ml-auto">
                            <a href="#category" class="list-icons-item" data-toggle="collapse" aria-expanded="true">
                                <i class="icon-arrow-down12"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show" id="category">
                        <div class="card-body">
                            @include('backend.posts._categories', ['categories' => $categories, 'selected' => old('categories', $post->categories()->pluck('id')->toArray())])
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="sidebar-section-header">
                        <span class="font-weight-semibold">{{ __('Tags') }}</span>
                        <div class="list-icons ml-auto">
                            <a href="#tag" class="list-icons-item" data-toggle="collapse" aria-expanded="true">
                                <i class="icon-arrow-down12"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show" id="tag">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Add Tags') }}</label>
                                <select multiple="multiple" class="form-control" id="select-tag" data-fouc name="tags[]">
                                    @foreach($tags as $tag)
                                        <option {{ in_array($tag->name, old('tags', $post->tags()->pluck('name')->toArray())) ? 'selected' : null }} value="{{ $tag->name }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            $(function() {
                $('#select-tag').select2({
                    tags: true,
                    tokenSeparators: [',']
                });

                setSearchSelect2($('#select-projects'), "{{ route('projects.search') }}")
            })
        </script>
    @endpush
    
</x-app-layout>