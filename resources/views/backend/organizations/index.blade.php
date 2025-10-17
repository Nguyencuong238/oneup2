<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tổ chức</h5>

            <div class="d-flex justify-content-between mt-2">
                <form action="">
                    <input type="search" style="width: 300px;" class="form-control" name="search" value="" placeholder="{{ __('Search') }}">
                </form>
                <a href="{{ route('organizations.create') }}" class="btn btn-primary"><i class="icon-plus-circle2 mr-1"></i> {{ __('Create') }}</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Lĩnh vực</th>
                        <th>Quy mô</th>
                        <th>Người tạo</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizations as $organization)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                {{ $organization->name }}
                            </div>
                        </td>
                        <td>
                            <img src="{{ $organization->getFirstMediaUrl('media') }}" width="50">
                        </td>
                        <td>{{ $organization->website }}</td>
                        <td>{{ $organization->industry }}</td>
                        <td>{{ $organization->size }}</td>
                        <td>{{ $organization->created_by }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('organizations.edit', $organization) }}" class="dropdown-item"><i class="icon-pencil7"></i> {{ __('Edit') }}</a>
                                        <a href="javascript:void(0)" data-action-url="{{ route('organizations.destroy', $organization) }}" data-behavior="delete-resource" class="dropdown-item"><i class="icon-gear"></i> {{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $organizations->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4BK') }}
        </div>
    </div>
</x-app-layout>
