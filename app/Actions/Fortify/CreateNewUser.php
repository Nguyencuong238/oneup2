<?php

namespace App\Actions\Fortify;

use App\Models\Kol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'type' => ['required', 'in:kols,brand'],
        ])->validate();

        $kol = Kol::create([
            'username' => explode('@', $input['email'])[0],
            'display_name' => $input['name'],

        ]);

        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'type'    => $input['type'],
            'password' => Hash::make($input['password']),
            'kol_id' => $kol->id,
        ]);
    }
}
