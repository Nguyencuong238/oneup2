<x-master-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h2>Đăng ký tài khoản</h2>
                                </div>
    
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" placeholder="{{ __('Tên') }}" value="{{ old('name') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-mail5 text-muted"></i>
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
    
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Xác minh mật khẩu') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="icon-plus3 mr-2"></i>{{ __('Đăng ký') }}</button>
                                </div>
                                
                                <div class="form-group text-center text-muted content-divider">
                                    <span class="px-2">{{ __('Bạn đã có tài khoản?') }}</span>
                                </div>
    
                                <div class="form-group">
                                    <a href="{{ route('login') }}" class="btn btn-light btn-block"><i class="icon-circle-right2 mr-2"></i>{{ __('Đăng nhập') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>