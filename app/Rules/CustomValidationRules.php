<?php

namespace App\Rules;

use App\Models\AccountModel;
use Illuminate\Contracts\Validation\Rule;

class CustomValidationRules
{
    public static function email()
    {
        return new class implements Rule
        {
            public function passes($attribute, $value)
            {
                // Custom email validation logic here
                return !AccountModel::where('email', $value)->exists();
            }

            public function message()
            {
                return 'The email is already in use!.';
            }
        };
    }

    public static function username()
    {
        return new class implements Rule
        {
            public function passes($attribute, $value)
            {
                // Custom username validation logic here
                // You can check if the username already exists in the database
                return !AccountModel::where('username', $value)->exists();
            }

            public function message()
            {
                return 'The username is already taken.';
            }
        };
    }
}
