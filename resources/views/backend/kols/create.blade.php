<x-app-layout>
    <form action="{{ route('kols.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Thêm nhà sáng tạo nội dung</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Nền tảng') }}:</label>
                            <input type="text" name="platform_id" value="{{ old('platform_id') }}" class="form-control @error('platform_id')is-invalid @enderror" placeholder="Nhập nền tảng">
                            @error('platform_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Username') }}:</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username')is-invalid @enderror" placeholder="Nhập username">
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị:</label>
                            <input type="text" name="display_name" value="{{ old('display_name') }}" class="form-control @error('display_name')is-invalid @enderror" placeholder="Nhập tên hiển thị">
                            @error('display_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Bio') }}:</label>
                            <textarea name="bio" class="form-control @error('bio')is-invalid @enderror" placeholder="Tiểu sử">{{ old('bio') }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Người theo dõi:</label>
                            <input type="number" name="followers" value="{{ old('followers') }}" class="form-control @error('followers')is-invalid @enderror" placeholder="">
                            @error('followers')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Tỷ lệ tuơng tác: (%)</label>
                            <input type="number" name="engagement" value="{{ old('engagement') }}" class="form-control @error('engagement')is-invalid @enderror" placeholder="">
                            @error('engagement')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Điểm uy tín:</label>
                            <input type="number" name="trust_score" value="{{ old('trust_score') }}" class="form-control @error('trust_score')is-invalid @enderror" placeholder="">
                            @error('trust_score')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Giá 1 video Tiktok:</label>
                            <input type="number" name="price_tiktok" value="{{ old('price_tiktok') }}" class="form-control @error('price_tiktok')is-invalid @enderror" placeholder="">
                            @error('price_tiktok')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Giá gói Campagin:</label>
                            <input type="number" name="price_campaign" value="{{ old('price_campaign') }}" class="form-control @error('price_campaign')is-invalid @enderror" placeholder="">
                            @error('price_campaign')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Avatar') }}:</label>
                            @php
                                $kol = new \App\Models\Kol;
                            @endphp
                            <x-media-library-collection
                                name="media"
                                :model="$kol"
                                collection="media"
                                rules="mimes:png,jpeg,jpg,webp"
                                max-items="1"
                            />
                        </div>

                        <div class="form-group">
                            <label>Quốc gia:</label>
                            <input type="text" name="location_country" value="{{ old('location_country') }}" class="form-control @error('location_country')is-invalid @enderror" placeholder="Nhập quốc gia">
                            @error('location_country')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Thành phố:</label>
                            <input type="text" name="location_city" value="{{ old('location_city') }}" class="form-control @error('location_city')is-invalid @enderror" placeholder="Nhập thành phố">
                            @error('location_city')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ngôn ngữ:</label>
                            <input type="text" name="language" value="{{ old('language') }}" class="form-control @error('language')is-invalid @enderror" placeholder="Nhập ngôn ngữ">
                            @error('language')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_verified" {{ old('is_verified') == '1' ? 'checked' : null }} id="is_verified" value="1">
                                <label class="custom-control-label" for="is_verified">{{ __('Đã xác minh') }}?</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_featured" {{ old('is_featured') == '1' ? 'checked' : null }} id="is_featured" value="1">
                                <label class="custom-control-label" for="is_featured">{{ __('Nổi bật') }}?</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Tier') }}:</label>
                            <select name="tier" data-placeholder="{{ __('Chọn tier') }}"
                                class="form-control form-control-select2 @error('tier')is-invalid @enderror" data-fouc>
                                <option></option>
                                <option {{ old('tier') == 'nano' ? 'selected' : null }} value="nano">
                                    {{ __('Nano') }}</option>
                                <option {{ old('tier') == 'micro' ? 'selected' : null }} value="micro">
                                    {{ __('Micro') }}</option>
                                <option {{ old('tier') == 'mid' ? 'selected' : null }} value="mid">
                                    {{ __('Mid') }}</option>
                                <option {{ old('tier') == 'macro' ? 'selected' : null }} value="macro">
                                    {{ __('Macro') }}</option>
                                <option {{ old('tier') == 'mega' ? 'selected' : null }} value="mega">
                                    {{ __('Mega') }}</option>
                            </select>
                            @error('tier')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Trạng thái') }}:</label>
                            <select name="status" data-placeholder="{{ __('Chọn') }}"
                                class="form-control form-control-select2 @error('status')is-invalid @enderror" data-fouc>
                                <option></option>
                                <option {{ old('status') == 'active' ? 'selected' : null }} value="active">
                                    {{ __('Active') }}</option>
                                <option {{ old('status') == 'inactive' ? 'selected' : null }} value="inactive">
                                    {{ __('Inactive') }}</option>
                                <option {{ old('status') == 'banned' ? 'selected' : null }} value="banned">
                                    {{ __('Banned') }}</option>
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
                            <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ __('Save') }} </button>
                            <a href="{{ route('kols.index') }}" class="btn btn btn-light ml-2"><i class="icon-backward mr-2"></i>{{ __('Back') }} </a>
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
                            @include('backend.kols._categories', ['categories' => $categories, 'selected' => old('categories', [])])
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </form>

    @push('js')
        <script>
            $(function() {

            })
        </script>
    @endpush
    
</x-app-layout>