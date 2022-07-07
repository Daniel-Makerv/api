<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules;

class Store extends FormRequest
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
    public static function rules()
    {
        return [
            'nombre'           => ['required', 'string', 'regex:/^[a-z,A-Z,à,á,â,ä,ã,å,ą,č,ć,ę,è,é,ê,ë,ė,į,ì,
                                                          í,î,ï,ł,ń,ò,ó,ô,ö,õ,ø,ù,ú,û,ü,ų,ū,ÿ,ý,ż,ź,ñ,ç,č,š,ž,
                                                          À,Á,Â,Ä,Ã,Å,Ą,Ć,Č,Ė,Ę,È,É,Ê,Ë,Ì,Í,Î,Ï,Į,Ł,Ń,Ò,Ó,Ô,Ö,
                                                          Õ,Ø,Ù,Ú,Û,Ü,Ų,Ū,Ÿ,Ý,Ż,Ź,Ñ,ß,Ç,Œ,Æ,Č,Š,Ž,∂,ð, ]*$/'],
            'apellido_paterno' => ['required', 'string', 'regex:/^[a-z,A-Z,à,á,â,ä,ã,å,ą,č,ć,ę,è,é,ê,ë,ė,į,ì,
                                                          í,î,ï,ł,ń,ò,ó,ô,ö,õ,ø,ù,ú,û,ü,ų,ū,ÿ,ý,ż,ź,ñ,ç,č,š,ž,
                                                          À,Á,Â,Ä,Ã,Å,Ą,Ć,Č,Ė,Ę,È,É,Ê,Ë,Ì,Í,Î,Ï,Į,Ł,Ń,Ò,Ó,Ô,Ö,
                                                          Õ,Ø,Ù,Ú,Û,Ü,Ų,Ū,Ÿ,Ý,Ż,Ź,Ñ,ß,Ç,Œ,Æ,Č,Š,Ž,∂,ð, ]*$/'],
            'apellido_materno' => ['required', 'string', 'regex:/^[a-z,A-Z,à,á,â,ä,ã,å,ą,č,ć,ę,è,é,ê,ë,ė,į,ì,
                                                          í,î,ï,ł,ń,ò,ó,ô,ö,õ,ø,ù,ú,û,ü,ų,ū,ÿ,ý,ż,ź,ñ,ç,č,š,ž,
                                                          À,Á,Â,Ä,Ã,Å,Ą,Ć,Č,Ė,Ę,È,É,Ê,Ë,Ì,Í,Î,Ï,Į,Ł,Ń,Ò,Ó,Ô,Ö,
                                                          Õ,Ø,Ù,Ú,Û,Ü,Ų,Ū,Ÿ,Ý,Ż,Ź,Ñ,ß,Ç,Œ,Æ,Č,Š,Ž,∂,ð, ]*$/'],
            'email'            => ['required', 'email', 'regex:/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/', 
                                   'indisposable', 'unique:usuarios,email'],
            'telefono'         => ['required', 'string', 'min:10', 'max:10', 'regex:/^[1-9]{1}[0-9]{9}$/'],
            'edad'             => ['nullable'],
            'password'         => ['nullable', 'string', 'confirmed'],
            'id_rol_sistema'   => ['nullable', 'integer', 'exists:roles_sistema,id'],
            'id_rol_personal'  => ['nullable', 'integer', 'exists:roles_personal,id'],
            'avatar'           => ['nullable'],
            'sexo'           => ['nullable'],
            'fecha_nacimiento' => ['nullable', 'date', new Rules\UsuarioRequest],
            'status'           => ['nullable', 'boolean']
        ];
    }
}
