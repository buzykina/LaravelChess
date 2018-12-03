<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;


class EditUserRequest extends Request
{
/**
* Determine if the user is authorized to make this request.
*
* @return bool
*/
public function authorize()
{
//can be the owner of the record or an admin
return (Auth::user()->admin || Auth::user()->id === $this->id );
}

/**
* Get the validation rules that apply to the request.
*
* @return array
*/
public function rules()
{
return [
'name' => 'required|max:255',
'email' => 'required|email|max:255|unique:users,email,'.$this->id,
];
}
}