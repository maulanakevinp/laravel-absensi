<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LoginRule implements Rule
{
    private $pass;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pass)
    {
        $this->pass = $pass;
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
        if (!auth()->attempt(['nrp' => $value, 'password' => $this->pass])) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'NRP atau Password salah.';
    }
}
