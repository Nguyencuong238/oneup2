<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Update Password') }}
            <span class="d-block font-size-base">{{ __('Ensure your account is using a long, random password to stay secure.') }}</span>
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route('user-password.update') }}" method="POST">

            @csrf
            @method('PUT')
            
            <div class="form-group w-md-50">
                <label for="current_password">{{ __('Current Password') }}:</label>
                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password', 'updatePassword')is-invalid @enderror" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group w-md-50">
                <label for="password">{{ __('New Password') }}:</label>
                <input type="password" name="password" id="password" class="form-control @error('password', 'updatePassword')is-invalid @enderror" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group w-md-50">
                <label for="password_confirmation">{{ __('Confirm Password') }}:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword')is-invalid @enderror" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Save') }}</button>
        </form>
    </div>
</div>