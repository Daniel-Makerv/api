<?php

namespace App\Rules;

use App\Models\Ciudades;
use Illuminate\Contracts\Validation\Rule;

class CiudadDisponible implements Rule
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
        $pais = Ciudades::query()
            ->where('id', $value)
            ->where('status', 1)
            ->first();

        if (!$pais) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.ciudad_disponible');
    }
}
