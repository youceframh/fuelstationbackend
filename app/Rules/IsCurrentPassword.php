<?php

namespace App\Rules;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\Validation\Rule;

class IsCurrentPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $current_password = auth()->user()->password;
        return Hash::check($value, $current_password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'الكلمة السرية الحالية غير صحيحة';
    }
}
