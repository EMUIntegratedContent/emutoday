<?php

namespace Emutoday\Http\Requests;

use Emutoday\Http\Requests\Request;

class ExpertImage_StoreRequest extends Request
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
        'image_name' => 'alpha_num',
        ];
    }
}
