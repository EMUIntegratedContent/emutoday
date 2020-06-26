<?php

namespace Emutoday\Http\Requests;

use Emutoday\Http\Requests\Request;

class User_DeleteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('users') == auth()->user()->id) {
            return false;
        }
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
            //
        ];
    }
}
