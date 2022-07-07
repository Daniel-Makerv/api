<?php

namespace App\Rules;


use App\Helpers\ApiHelpers;
use Illuminate\Contracts\Validation\Rule;

class UsuarioRequest implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        {
            return ApiHelpers::canUseFechaNacimiento($value);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.fecha_nacimiento');
    }
}
