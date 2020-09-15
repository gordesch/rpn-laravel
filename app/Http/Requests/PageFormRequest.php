<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                Rule::unique('pages')->ignore($this->page),
            ],
            'raw_content' => ['string', 'nullable'],
            'content' => ['string', 'nullable'],
        ];
    }

    public function persist(?Page $page = null): Page
    {

        if ($page) {
            $page->update($this->validated());
            return $page;
        }
        return Page::create($this->validated());
    }

    protected function prepareForValidation(): void
    {
        foreach ($this->raw as $name => $raw) {
            $this->merge([
                "raw_{$name}" => $raw,
                $name => null,
            ]);
        }
    }
}
