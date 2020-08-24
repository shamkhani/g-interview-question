<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsEditRequest extends FormRequest
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
//            'category_id'=>  'required|exists:App\Models\NewsCategory, id',
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'short_description'=>'max:2048',
            'description'=> 'required',
            'publish_date'=> 'date_format:Y-m-d',
            'feature_image'=> 'mimes:jpeg,bmp,png|max:2048',
            'status' => Rule::in(['draft', 'published']),
            'created_by' => 'exists:App\User,id',
            'updated_by' => 'exists:App\User,id',
            'external_id'=>'regex:/^de/article\/[a-zA-Z]\w*/i',
        ];
    }
}
