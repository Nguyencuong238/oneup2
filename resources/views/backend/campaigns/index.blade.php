<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Chiến dịch</h5>

            <div class="d-flex justify-content-between mt-2">
                <form action="">
                    <input type="search" style="width: 300px;" class="form-control" name="search" value=""
                        placeholder="{{ __('Search') }}">
                </form>
                {{-- <a href="{{ route('campaigns.create') }}" class="btn btn-primary"><i class="icon-plus-circle2 mr-1"></i> {{ __('Create') }}</a> --}}
            </div>
        </div>
        @php
            $statusText = [
                'active' => 'Đang hoạt động',
                'paused' => 'Tạm dừng',
                'completed' => 'Đã hoàn thành',
                'cancelled' => 'Đã hủy',
                'draft' => 'Bản nháp',
                'pending' => 'Chờ duyệt',
            ];
        @endphp
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tổ chức</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Ngân sách</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Người tạo</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{ $campaign->name }}
                                </div>
                            </td>
                            <td>
                                {{ $campaign->name }}
                            </td>
                            <td>{{ $campaign->description }}</td>
                            <td>{{ numberFormat($campaign->budget_amount) }} {{ $campaign->budget_currency }}</td>
                            <td>{{ $statusText[$campaign->status] }}</td>
                            <td>{{ $campaign->start_date->format('d/m/Y') }} ->
                                {{ $campaign->end_date->format('d/m/Y') }}</td>
                            <td>{{ $campaign->author?->name }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                class="icon-menu7"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('campaigns.edit', $campaign) }}" class="dropdown-item"><i
                                                    class="icon-pencil7"></i> {{ __('Edit') }}</a>
                                            <a href="javascript:void(0)"
                                                data-action-url="{{ route('campaigns.destroy', $campaign) }}"
                                                data-behavior="delete-resource" class="dropdown-item"><i
                                                    class="icon-gear"></i> {{ __('Delete') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $campaigns->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4BK') }}
        </div>
    </div>
</x-app-layout>
