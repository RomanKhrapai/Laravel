<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OldPassword implements ValidationRule
{
    protected  $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!(Hash::check($value, $this->user->password) ||
            Hash::check('', $this->user->password))) {
            $fail('old password not correct!!!');
        }
    }
}
