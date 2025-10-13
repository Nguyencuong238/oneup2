<x-master-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form wmin-sm-400" method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-lock2 icon-2x text-warning border-warning border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                    <span class="d-block text-muted text-left">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</span>
                                </div>
                                
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" placeholder="{{ __('Password') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Confirm') }}
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