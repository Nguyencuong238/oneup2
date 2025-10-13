<x-master-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <h2>Đăng nhập</h2>
                                </div>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" placeholder="{{ __('Mật khẩu') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="form-group d-flex align-items-center mb-4">
                                    <label class="custom-control custom-checkbox" for="remember_me">
                                        <input type="checkbox" name="remember" id="remember_me" class="custom-control-input" {{ old('remember_me') ? 'checked' : '' }}>
                                        <span class="custom-control-label fw-normal">{{ __('Ghi nhớ mật khẩu') }}</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="ml-auto">{{ __('Quên mật khẩu?') }}</a>
                                    @endif
                                </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="icon-circle-right2 mr-2"></i>{{ __('Đăng nhập') }}</button>
                                </div>
    
                                {{--  <div class="form-group text-center text-muted content-divider">
                                    <span class="px-2">{{ __('Bạn đã đăng ký chưa?') }}</span>
                                </div>
    
                                <div class="form-group">
                                    <a href="{{ route('register') }}" class="btn btn-light btn-block"><i class="icon-circle-right2 mr-2"></i>{{ __('Đăng ký') }}</a>
                                </div>  --}}
    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>