<x-master-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form wmin-sm-400" method="POST" action="{{ route('two-factor.login') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body" x-data="{ recovery: false }">
                                <div class="text-center mb-3" x-show="! recovery">
                                    <i class="icon-qrcode icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                    <span class="d-block text-muted text-left">{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</span>
                                </div>
                                <div class="text-center mb-3" x-show="recovery" style="display: none;">
                                    <i class="icon-qrcode icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                    <span class="d-block text-muted text-left">{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</span>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left" x-show="! recovery">
                                    <input type="text" name="code" x-ref="code" class="form-control @error('code')is-invalid @enderror" placeholder="{{ __('Code') }}" value="{{ old('code') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-codepen text-muted"></i>
                                    </div>
                                    @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left" x-show="recovery" style="display: none;">
                                    <input type="text" name="recovery_code" x-ref="recovery_code" class="form-control @error('recovery_code')is-invalid @enderror" placeholder="{{ __('Recovery Code') }}" value="{{ old('recovery_code') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-codepen text-muted"></i>
                                    </div>
                                    @error('recovery_code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-outline-secondary" x-show="! recovery" x-on:click="
                                                        recovery = true;
                                                        $nextTick(() => { $refs.recovery_code.focus() })
                                                    ">
                                        {{ __('Use a recovery code') }}
                                    </button>
            
                                    <button type="button" class="btn btn-outline-secondary" x-show="recovery" x-on:click="
                                                        recovery = false;
                                                        $nextTick(() => { $refs.code.focus() })
                                                    " style="display: none;">
                                        {{ __('Use an authentication code') }}
                                    </button>
            
                                    <button type="submit" class="ml-2 btn btn-primary text-uppercase">
                                        {{ __('Log in') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>