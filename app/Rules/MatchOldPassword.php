<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Hash;
use Auth;
use DB;

class MatchOldPassword implements Rule
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
        $table= DB::table("users")
        ->where("id",Auth::user()->id)
        ->select("id","password")
        ->first();

        return Hash::check($value, Auth::user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
