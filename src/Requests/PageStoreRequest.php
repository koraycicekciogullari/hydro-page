<?php

namespace Koraycicekciogullari\HydroPage\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         =>  ['required'],
            'description'   =>  ['required', 'max:160'],
            'content'       =>  ['required'],
            'show_in_menu'  =>  ['required'],
            'show_in_footer'  =>  ['required'],
        ];
    }
}
