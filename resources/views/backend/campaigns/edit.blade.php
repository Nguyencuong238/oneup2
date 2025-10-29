<x-app-layout>
    <form action="{{ route('campaigns.update', $campaign) }}" method="post">
        @csrf
        @method('PUT')
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
                            <label>Tổ chức:</label>
                            <select name="organization_id" data-placeholder="{{ __('Chọn') }}"
                                class="form-control form-control-select2 @error('organization_id')is-invalid @enderror">
                                <option></option>
                                @foreach ($organizations as $org)
                                    <option {{ old('organization_id', $campaign->organization_id) == $org->id ? 'selected' : null }}
                                        value="{{ $org->id }}">
                                        {{ $org->name }}</option>
                                @endforeach()

                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Name') }}:</label>
                            <input type="text" name="name" value="{{ old('name', $campaign->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mô tả:</label>
                            <input type="text" name="description" value="{{ old('description', $campaign->description) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Đối tượng:</label>
                            <select name="objective" data-placeholder="{{ __('Chọn') }}"
                                class="form-control form-control-select2 @error('objective')is-invalid @enderror"
                                data-fouc>
                                <option></option>
                                <option {{ old('objective', $campaign->objective) == 'awareness' ? 'selected' : null }} value="awareness">
                                    {{ __('Nhận diện') }}</option>
                                <option {{ old('objective', $campaign->objective) == 'engagement' ? 'selected' : null }} value="engagement">
                                    {{ __('Tương tác') }}</option>
                                <option {{ old('objective', $campaign->objective) == 'traffic' ? 'selected' : null }} value="traffic">
                                    {{ __('Lượng truy cập') }}</option>
                                <option {{ old('objective', $campaign->objective) == 'conversions' ? 'selected' : null }}
                                    value="conversions">
                                    {{ __('Chuyển đổi') }}</option>
                                <option {{ old('objective', $campaign->objective) == 'sales' ? 'selected' : null }} value="sales">
                                    {{ __('Doanh số') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ngân sách:</label>
                            <input type="number" name="budget_amount" value="{{ old('budget_amount', $campaign->budget_amount) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tiền tệ:</label>
                            <input type="text" name="budget_currency" value="{{ old('budget_currency', $campaign->budget_currency) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Ngày bắt đầu:</label>
                            <div class="input-group">
                                <input type="text" name="start_date" value="{{ old('start_date', $campaign->start_date) }}"
                                    class="form-control date cursor-pointer">
                                <div class="input-group-append date-picker-icon cursor-pointer">
                                    <span class="input-group-text">
                                        <i class="icon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ngày kết thúc:</label>
                            <div class="input-group">
                                <input type="text" name="end_date" value="{{ old('end_date', $campaign->end_date) }}"
                                    class="form-control date cursor-pointer">
                                <div class="input-group-append date-picker-icon cursor-pointer">
                                    <span class="input-group-text">
                                        <i class="icon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Phạm vi tiếp cận:</label>
                            <input type="number" name="target_reach" value="{{ old('target_reach', $campaign->target_reach) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Mức độ tương tác mục tiêu:</label>
                            <input type="number" name="target_engagement" value="{{ old('target_engagement', $campaign->target_engagement) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Mức chuyển đổi mục tiêu:</label>
                            <input type="number" name="target_conversions" value="{{ old('target_conversions', $campaign->target_conversions) }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Trạng thái') }}:</label>
                            <select name="status" data-placeholder="{{ __('Chọn') }}"
                                class="form-control form-control-select2 @error('status')is-invalid @enderror"
                                data-fouc>
                                <option></option>
                                {{-- <option {{ old('status', $campaign->status) == 'draft' ? 'selected' : null }} value="draft">
                                    Nháp</option> --}}
                                <option {{ old('status', $campaign->status) == 'pending' ? 'selected' : null }} value="pending">
                                    Chờ duyệt</option>
                                <option {{ old('status', $campaign->status) == 'active' ? 'selected' : null }} value="active">
                                    Kích hoạt</option>
                                <option {{ old('status', $campaign->status) == 'paused' ? 'selected' : null }} value="paused">
                                    Tạm dừng</option>
                                <option {{ old('status', $campaign->status) == 'completed' ? 'selected' : null }} value="completed">
                                    Hoàn thành</option>
                                <option {{ old('status', $campaign->status) == 'cancelled' ? 'selected' : null }} value="cancelled">
                                    Đã hủy</option>
                            </select>
                            @error('status')
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
                            <a href="{{ route('campaigns.index') }}" class="btn btn btn-light ml-2"><i
                                    class="icon-backward mr-2"></i>{{ __('Back') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script></script>
    @endpush

</x-app-layout>
