@extends('layouts.front')

@push('css')
    <style>
        :root {
            --text-red-color: #f44a4a;
            --background-white-bg-color: #fff;
            --text-black-color: #29303b;
        }
        .profile-item-block {
            padding: 40px 0;
            background-color: #F6F7FC;
        }
        .profile-info-block {
            padding: 30px 15px;
            background-color: var(--background-white-bg-color);
            margin-bottom: 41px;
            border-radius: 6px;
        }
        .profile-info-block .profile-heading {
            font-size: 20px;
            color: var(--text-black-color);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .card {
            border: 0;
        }
        .card-header {
            background: #fff;
            border-bottom: 0;
        }
        .card-title {
            font-size: 20px;
        }
        .font-size-base {
            font-size: 14px;
            color: #716E6E;
            font-weight: 400;
        }
        .btn.btn-primary {
            border-radius: 3px;
        }
        .form-group label {
            font-weight: 500;
        }
        @media(max-width: 1919px) {
            
        }
        @media(max-width: 1599px) {
            
        }
        @media(max-width: 1399px) {
            
        }
        @media(max-width: 1199px) {
            
        }
        @media(max-width: 991px) {
            
        }
        @media(max-width: 767px) {
            
        }
        @media(max-width: 575px) {
            
        }
        @media(max-width: 400px) {
            
        }
    </style>
@endpush
@section('page')
<section id="profile-item" class="profile-item-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('front.user._sidebar')
            </div>
            
            <div class="col-xl-9 col-lg-8">
                <div class="profile-info-block">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                {{ __('Thông tin tài khoản') }}
                                <span class="d-block font-size-base">{{ __('Cập nhật thông tin tài khoản và địa chỉ email.') }}</span>
                            </h5>
                        </div>
                    
                        <div class="card-body">
                            <form action="{{ route('user-profile-information.update') }}" method="POST">
                    
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group w-md-50">
                                    <label for="name">{{ __('Tên') }}:</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-control @error('name', 'updateProfileInformation')is-invalid @enderror">
                                    @error('name', 'updateProfileInformation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="form-group w-md-50">
                                    <label for="email">{{ __('Email') }}:</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-control @error('email', 'updateProfileInformation')is-invalid @enderror">
                                    @error('email', 'updateProfileInformation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                    
                                <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="profile-info-block">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            {{ __('Cập nhật mật khẩu') }}
                            <span class="d-block font-size-base">{{ __('Đảm bảo tài khoản của bạn đang sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.') }}</span>
                        </h5>
                    </div>
                
                    <div class="card-body">
                        <form action="{{ route('user-password.update') }}" method="POST">
                
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group w-md-50">
                                <label for="current_password">{{ __('Mật khẩu hiện tại') }}:</label>
                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password', 'updatePassword')is-invalid @enderror" autocomplete="current-password">
                                @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="form-group w-md-50">
                                <label for="password">{{ __('Mật khẩu mới') }}:</label>
                                <input type="password" name="password" id="password" class="form-control @error('password', 'updatePassword')is-invalid @enderror" autocomplete="new-password">
                                @error('password', 'updatePassword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="form-group w-md-50">
                                <label for="password_confirmation">{{ __('Nhập lại mật khẩu mới') }}:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword')is-invalid @enderror" autocomplete="new-password">
                                @error('password_confirmation', 'updatePassword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                
                
                            <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                        </form>
                    </div>
                </div>
                @endif
                </div>

                <div class="profile-info-block">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            {{ __('Xác thực hai yếu tố') }}
                            <span class="d-block font-size-base">{{ __('Thêm bảo mật bổ sung cho tài khoản của bạn bằng xác thực hai yếu tố.') }}</span>
                        </h5>
                    </div>
                
                    <div class="card-body">
                        <h3 class="h5 font-weight-bold">
                            @if (auth()->user()->two_factor_secret)
                                {{ __('Bạn đã bật xác thực hai yếu tố.') }}
                            @else
                                {{ __('Bạn chưa bật xác thực hai yếu tố.') }}
                            @endif
                        </h3>
                
                        <p class="mt-3">
                            {{ __('Khi bật xác thực hai yếu tố, bạn sẽ được nhắc nhập mã thông báo ngẫu nhiên, an toàn trong quá trình xác thực. Bạn có thể truy xuất mã thông báo này từ ứng dụng Google Authenticator trên điện thoại của mình.') }}
                        </p>
                
                        @if(auth()->user()->two_factor_secret)
                            @if(session('status') == 'two-factor-authentication-enabled')
                                <p class="mt-3">
                                    {{ __('Xác thực hai yếu tố hiện đã được bật. Quét mã QR sau bằng ứng dụng xác thực trên điện thoại của bạn.') }}
                                </p>
                
                                <div class="mt-3">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>
                            @endif
                
                            <p class="mt-3">
                                {{ __('Lưu trữ các mã khôi phục này trong trình quản lý mật khẩu an toàn. Chúng có thể được sử dụng để khôi phục quyền truy cập vào tài khoản của bạn nếu thiết bị xác thực hai yếu tố của bạn bị mất.') }}
                            </p>
                
                            <div class="bg-light rounded p-3">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </div>
                
                            <div class="mt-3 d-sm-flex">
                                {{-- Regenerate 2FA Recovery Codes --}}
                                <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                                    @csrf
                
                                    <button type="submit" class="btn btn-success"><i class="icon-qrcode mr-2"></i>{{ __('Tạo lại mã khôi phục') }}</button>
                                        
                                </form>
                
                                {{-- Disable 2FA --}}
                
                                <form method="POST" action="{{ url('user/two-factor-authentication') }}" class="ml-sm-3 mt-3 mt-sm-0">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="btn btn-danger"><i class="icon-switch2 mr-2"></i>{{ __('Tắt') }}</button>
                                </form>
                
                                
                            </div>
                            
                        @else
                            {{-- Enable 2FA --}}
                            <form action="{{ url('user/two-factor-authentication') }}" method="POST">
                                @csrf
                
                                <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Bật') }}</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endif
                </div>
            </div>
        </div>

    </div>
</section>
@stop

@section('custom-js')

@endsection