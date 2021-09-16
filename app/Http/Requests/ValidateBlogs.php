<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBlogs extends FormRequest
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
        if ($this->id){
            return [
                'title' => 'required',
                'content' => 'required',
                'slug' => 'required|unique:blogs,slug,'.$this->id,
            ];
        }else{
            return [
                'title' => 'required',
                'content' => 'required',
                'slug' => 'required|unique:blogs',
            ];
        }
    }
}
