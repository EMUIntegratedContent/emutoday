<?php

namespace Emutoday\Http\Requests;

use Emutoday\Http\Requests\Request;

class StoryImage_UpdateRequest extends Request
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
          'image_name' => 'required',
          'image_type' => 'required'
  ];
    }
}
