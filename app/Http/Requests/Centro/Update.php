<?php

namespace App\Http\Requests\Centro;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'               => ['required', 'integer', 'exists:centros,id'],
            'nombre'           => ['required', 'string', 'regex:/^[a-z,A-Z,à,á,â,ä,ã,å,ą,č,ć,ę,è,é,ê,ë,ė,į,ì,
                                                          í,î,ï,ł,ń,ò,ó,ô,ö,õ,ø,ù,ú,û,ü,ų,ū,ÿ,ý,ż,ź,ñ,ç,č,š,ž,
                                                          À,Á,Â,Ä,Ã,Å,Ą,Ć,Č,Ė,Ę,È,É,Ê,Ë,Ì,Í,Î,Ï,Į,Ł,Ń,Ò,Ó,Ô,Ö,
                                                          Õ,Ø,Ù,Ú,Û,Ü,Ų,Ū,Ÿ,Ý,Ż,Ź,Ñ,ß,Ç,Œ,Æ,Č,Š,Ž,∂,ð, ]*$/'],
            
            'status'           => ['nullable', 'boolean']
        ];
    }
}
