<x-app-layout>
    <form action="{{ route('kols.update', $kol) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Chỉnh sửa nhà sáng tạo nội dung</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Nền tảng') }}:</label>
                            <select name="platform" data-placeholder="{{ __('Chọn nền tảng') }}"
                                class="form-control form-control-select2 @error('platform')is-invalid @enderror">
                                <option @if (old('platform', $kol->platform) == 'tiktok') selected @endif value="tiktok">
                                    TikTok</option>
                                <option @if (old('platform', $kol->platform) == 'facebook') selected @endif value="facebook">
                                    Facebook</option>
                                <option @if (old('platform', $kol->platform) == 'youtube') selected @endif value="youtube">
                                    Youtube</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Username') }}:</label>
                            <input type="text" name="username" value="{{ old('username', $kol->username) }}"
                                class="form-control @error('username')is-invalid @enderror" placeholder="Nhập username"
                                required>
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị:</label>
                            <input type="text" name="display_name"
                                value="{{ old('display_name', $kol->display_name) }}" class="form-control"
                                placeholder="Nhập tên hiển thị">
                            @error('display_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Bio') }}:</label>
                            <textarea name="bio" class="form-control" placeholder="Tiểu sử">{{ old('bio', $kol->bio) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Dạng nội dung:</label>
                            <textarea name="content_type" class="form-control" placeholder="Dạng nội dung">{{ old('content_type', $kol->content_type) }}</textarea>
                        </div>


                        <div class="form-group">
                            <label>Người theo dõi:</label>
                            <input type="number" name="followers" value="{{ old('followers', $kol->followers) }}"
                                class="form-control @error('followers')is-invalid @enderror" placeholder="">
                            @error('followers')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Tỷ lệ tuơng tác: (%)</label>
                            <input type="number" name="engagement" value="{{ old('engagement', $kol->engagement) }}"
                                class="form-control">
                        </div>


                        <div class="form-group">
                            <label>Điểm uy tín:</label>
                            <input type="number" name="trust_score"
                                value="{{ old('trust_score', $kol->trust_score) }}" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Giá 1 video Tiktok:</label>
                            <input type="number" name="price_tiktok"
                                value="{{ old('price_tiktok', $kol->price_tiktok - 0) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Giá gói Campagin:</label>
                            <input type="number" name="price_campaign" class="form-control"
                                value="{{ old('price_campaign', $kol->price_campaign - 0) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Avatar') }}:</label>
                            <x-media-library-collection name="media" :model="$kol" collection="media"
                                rules="mimes:png,jpeg,jpg,webp" max-items="1" />
                        </div>

                        <div class="form-group">
                            <label>Quốc gia:</label>
                            <select name="location_country" data-placeholder="{{ __('Chọn ngôn ngữ') }}"
                                class="form-control form-control-select2 @error('location_country')is-invalid @enderror">
                                <option
                                    {{ old('location_country', $kol->location_country) == 'vn' ? 'selected' : null }}
                                    value="vn">
                                    Việt Nam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Thành phố:</label>
                            <input type="text" name="location_city"
                                value="{{ old('location_city', $kol->location_city) }}" class="form-control"
                                placeholder="Nhập thành phố">
                        </div>

                        <div class="form-group">
                            <label>Ngôn ngữ:</label>
                            <select name="language" data-placeholder="{{ __('Chọn ngôn ngữ') }}"
                                class="form-control form-control-select2 @error('language')is-invalid @enderror">
                                <option {{ old('language', $kol->language) == 'vi' ? 'selected' : null }}
                                    value="vi">
                                    Tiếng Việt</option>
                                <option {{ old('language', $kol->language) == 'en' ? 'selected' : null }}
                                    value="en">
                                    Tiếng Anh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_verified"
                                    {{ old('is_verified', $kol->is_verified, 1) == '1' ? 'checked' : null }}
                                    id="is_verified" value="1">
                                <label class="custom-control-label" for="is_verified">{{ __('Đã xác minh') }}?</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_featured"
                                    {{ old('is_featured', $kol->is_featured) == '1' ? 'checked' : null }}
                                    id="is_featured" value="1">
                                <label class="custom-control-label" for="is_featured">{{ __('Nổi bật') }}?</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="blue_tick"
                                    {{ old('blue_tick', $kol->blue_tick) == '1' ? 'checked' : null }} id="blue_tick"
                                    value="1">
                                <label class="custom-control-label" for="blue_tick">{{ __('Tích xanh') }}?</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Tier') }}:</label>
                            <select name="tier" data-placeholder="{{ __('Chọn tier') }}"
                                class="form-control form-control-select2">
                                <option {{ old('tier', $kol->tier) == 'nano' ? 'selected' : null }} value="nano">
                                    {{ __('Nano') }}</option>
                                <option {{ old('tier', $kol->tier) == 'micro' ? 'selected' : null }} value="micro">
                                    {{ __('Micro') }}</option>
                                <option {{ old('tier', $kol->tier) == 'mid' ? 'selected' : null }} value="mid">
                                    {{ __('Mid') }}</option>
                                <option {{ old('tier', $kol->tier) == 'macro' ? 'selected' : null }} value="macro">
                                    {{ __('Macro') }}</option>
                                <option {{ old('tier', $kol->tier) == 'mega' ? 'selected' : null }} value="mega">
                                    {{ __('Mega') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Trạng thái') }}:</label>
                            <select name="status" data-placeholder="{{ __('Chọn') }}"
                                class="form-control form-control-select2">
                                <option {{ old('status', $kol->status) == 'active' ? 'selected' : null }}
                                    value="active">
                                    Kích hoạt</option>
                                <option {{ old('status', $kol->status) == 'inactive' ? 'selected' : null }}
                                    value="inactive">
                                    Chưa kích hoạt</option>
                                <option {{ old('status', $kol->status) == 'banned' ? 'selected' : null }}
                                    value="banned">
                                    Bị cấm</option>
                            </select>
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
                            <a href="{{ route('kols.index') }}" class="btn btn btn-light ml-2"><i
                                    class="icon-backward mr-2"></i>{{ __('Back') }} </a>
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
                            @include('backend.kols._categories', [
                                'categories' => $categories,
                                'selected' => old('categories', $kol->categories()->pluck('id')->toArray()),
                            ])
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
