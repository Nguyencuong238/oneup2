<?php

namespace App\Http\Requests\Backend\Partner;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibraryPro\Rules\Concerns\ValidatesMedia;

class Store extends FormRequest
{
    use ValidatesMedia;

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
            'name'          => ['required'],
            'twitter_url'   => ['nullable', 'url'],
            'facebook_url'  => ['nullable', 'url'],
            'telegram_url'  => ['nullable', 'url'],
            'website_url'   => ['nullable', 'url'],
            'media'         => ['required', $this->validateSingleMedia()
                ->maxItemSizeInKb(3000),
            ],
        ];
    }
}
