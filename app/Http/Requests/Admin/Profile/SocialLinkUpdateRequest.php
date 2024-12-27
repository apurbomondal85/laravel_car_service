<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class SocialLinkUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'facebook_url'  => ['nullable', 'string'],
            'linkedin_url'  => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'string'],
            'twitter_url'   => ['nullable', 'string'],
        ];
    }
}
