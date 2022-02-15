<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

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
            'name' => ['required', 'string', 'max:255'],
            //'first_name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'first_name' => $input['first_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
        $last_insert_id = User::all()->last()->id;

        DB::table('model_has_roles')->insert(['role_id' => $input['role'], 'model_type' => 'App\Models\User', 'model_id' => $last_insert_id,]);
         
        return $user;
    }
}
