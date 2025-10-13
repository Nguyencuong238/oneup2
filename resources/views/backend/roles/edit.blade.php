<x-app-layout>
    @push('js')
        <script>
            $(function () {
                $('.permission-group-actions > .allow-all, .permission-group-actions > .deny-all').on('click', (e) => {
                    let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];
                    $(e.currentTarget).closest('.permission-group')
                    .find(`.permission-${action}`)
                    .each((index, value) => {
                        $(value).prop('checked', true);
                    });
                });
                $('.permission-parent-actions > .allow-all, .permission-parent-actions > .deny-all').on('click', (e) => {
                    let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];
                    $(`.permission-${action}`).prop('checked', true);
                });
            })
        </script>
    @endpush
    <form action="{{ route('roles.update', $role) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ __('Edit Role') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Role') }}:</label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control @error('name')is-invalid @enderror" placeholder="Admin, ...">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="collapse show" id="permissions">
                                @foreach($groupPermissions as $groupKey => $permissions)
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">

                                        <div class="clearfix"></div>

                                        <div class="permission-group mt-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="permission-group-head">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4">
                                                            </div>

                                                            <div class="col-md-8 col-sm-8">
                                                                <div class="btn-group permission-group-actions float-right">
                                                                    <button type="button" class="btn btn-light allow-all">{{ __('Allow all') }}</button>
                                                                    <button type="button" class="btn btn-light deny-all">{{ __('Deny all') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        @foreach($permissions as $permission)
                                                            <div class="permission-row">
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-4">
                                                                        <span class="permission-label">
                                                                            {{ $permission->name }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-md-7 col-sm-8">
                                                                        <div class="form-group float-right mr-2">
                                                                            <div class="form-check form-check-inline">
                                                                                <input type="radio" id="a_p_{{ $permission->id }}" class="form-check-input permission-allow" {{ in_array($permission->name, $allowPermissions) ? 'checked' : null }} name="permissions[{{ $permission->name }}]" value="1">
                                                                                <label class="form-check-label" for="a_p_{{ $permission->id }}">{{ __('Allow') }}</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input type="radio" class="form-check-input permission-deny"
                                                                                    id="d_p_{{ $permission->id }}"
                                                                                    {{ !in_array($permission->name, $allowPermissions) ? 'checked' : null }}
                                                                                    name="permissions[{{ $permission->name }}]" value="0"
                                                                                >
                                                                                <label class="form-check-label" for="d_p_{{ $permission->id }}">{{ __('Deny' )}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
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