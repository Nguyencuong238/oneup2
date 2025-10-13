<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Two Factor Authentication') }}
            <span class="d-block font-size-base">{{ __('Add additional security to your account using two factor authentication.') }}</span>
        </h5>
    </div>

    <div class="card-body">
        <h3 class="h5 font-weight-bold">
            @if (auth()->user()->two_factor_secret)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if(auth()->user()->two_factor_secret)
            @if(session('status') == 'two-factor-authentication-enabled')
                <p class="mt-3">
                    {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>

                <div class="mt-3">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            <p class="mt-3">
                {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
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

                    <button type="submit" class="btn btn-success"><i class="icon-qrcode mr-2"></i>{{ __('Regenerate Recovery Codes') }}</button>
                        
                </form>

                {{-- Disable 2FA --}}

                <form method="POST" action="{{ url('user/two-factor-authentication') }}" class="ml-sm-3 mt-3 mt-sm-0">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger"><i class="icon-switch2 mr-2"></i>{{ __('Disable') }}</button>
                </form>

                
            </div>
            
        @else
            {{-- Enable 2FA --}}
            <form action="{{ url('user/two-factor-authentication') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Enable') }}</button>
            </form>
        @endif
    </div>
</div>