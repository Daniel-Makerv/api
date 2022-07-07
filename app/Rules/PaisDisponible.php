<?php

namespace App\Rules;

use App\Models\Paises;
use Illuminate\Contracts\Validation\Rule;

class PaisDisponible implements Rule
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
        $pais = Paises::query()
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
        return trans('validation.pais_disponible');
    }
}
