<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class client_Request extends FormRequest
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
          'Client_name'=>'required',
          'Client_mail'=>'required|email',
          'Client_adresse'=>'required',
          'Client_servers_nbr'=>'required|integer|min:1'
        ];
    }
}
