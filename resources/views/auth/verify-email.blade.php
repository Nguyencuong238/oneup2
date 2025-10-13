<x-master-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form wmin-sm-400" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span class="d-block text-muted text-left">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</span>
                                </div>
                                
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert bg-success text-white alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif

                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="icon-spinner11 mr-2"></i> 
                                        {{ __('Resend Verification Email') }}
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