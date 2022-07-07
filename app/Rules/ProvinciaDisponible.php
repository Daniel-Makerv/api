<?php

namespace App\Rules;

use App\Models\Provincias;
use Illuminate\Contracts\Validation\Rule;

class ProvinciaDisponible implements Rule
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
        $provincia = Provincias::query()
            ->where('id', $value)
            ->where('status', 1)
            ->first();

        if (!$provincia) {
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
        return trans('validation.provinvia_disponible');
    }
}
