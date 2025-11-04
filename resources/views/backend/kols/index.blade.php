<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ __('KOLs') }}</h5>

            <div class="d-flex justify-content-between mt-2">
                <form action="">
                <input type="search" style="width: 300px;" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search">
                </form>
                <a href="{{ route('kols.create') }}" class="btn btn-primary"><i class="icon-plus-circle2 mr-1"></i> {{ __('Create') }}</a>
            </div>
        </div>
        @php
            $statusTexts = [
                'active' => 'Kích hoạt',
                'inactive' => 'Chưa kích hoạt',
                'banned' => 'Bị cấm',
            ];   
        @endphp
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Avatar') }}</th>
                        <th>{{ __('Categories') }}</th>
                        <th>Trạng thái</th>
                        <th>{{ __('Date') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kols as $kol)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kol->display_name }}</td>
                        <td>{{ $kol->username }}</td>
                        <td><img src="{{ $kol->getFirstMediaUrl('media') }}" width="50px"></td>
                        <td>
                            @if($kol->categories->isEmpty())
                                --
                            @else
                                @foreach($kol->categories as $category)
                                    <a href="{{ route('kols.index', ['category' => $category->slug]) }}">{{ $category->name }}</a> @if(!$loop->last),  @endif 
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $statusTexts[$kol->status] ?? '' }}</td>
                        <td>{{ formatDate($kol->created_at) }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('kols.edit', $kol) }}" class="dropdown-item"><i class="icon-pencil7"></i> {{ __('Edit') }}</a>
                                        <a href="javascript:void(0)" data-action-url="{{ route('kols.destroy', $kol) }}" data-behavior="delete-resource" class="dropdown-item"><i class="icon-gear"></i> {{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $kols->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4BK') }}
        </div>
    </div>
</x-app-layout>