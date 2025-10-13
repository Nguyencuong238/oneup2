<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Profile Information') }}
            <span class="d-block font-size-base">{{ __('Update your account\'s profile information and email address.') }}</span>
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route('user-profile-information.update') }}" method="POST">

            @csrf
            @method('PUT')
            
            <div class="form-group w-md-50">
                <label for="name">{{ __('Name') }}:</label>
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


            <button type="submit" class="btn btn-primary"><i class="icon-paperplane mr-2"></i>{{ __('Save') }}</button>
        </form>
    </div>
</div>