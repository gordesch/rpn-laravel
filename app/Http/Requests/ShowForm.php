<?php

namespace App\Http\Requests;

use App\Show;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Http\FormRequest;

class ShowForm extends FormRequest
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
        if ($this->method() === 'PUT')
        {
            // Update operation, exclude the record from the validation:
            $slug_rule = 'required|string|max:255|unique:shows,slug,' . $this->route('show')->id;
        } else {
            // Create operation. There is no ID yet.
            $slug_rule = 'required|string|max:255|unique:shows,slug';
        }
        return [
            'title' => 'required|string|max:255',
            'slug' => $slug_rule,
            'genre' => 'string|max:255|nullable',
            'duration_in_seconds' => 'numeric|nullable',
            'country' => 'string|max:255|nullable',
            'year' => 'numeric|nullable',
            'director' => 'string|max:255|nullable',
            'cast' => 'string|max:255|nullable',
            'synopsis' => 'string|nullable',
            'audience' => 'in:2,3,4,5,6,7,8,12,16,18,av|nullable',
        ];
    }

    public function persist(Show $show) {
        Show::create($this->only($show->getFillable()));
    }

    public function update(Show $show) {
        $show->update($this->only($show->getFillable()));
    }

    protected function prepareForValidation()
    {
        if ($this->hours || $this->minutes) {
            $this->merge([
                'duration_in_seconds' => CarbonInterval::hours($this->hours)->minutes($this->minutes)->totalSeconds,
            ]);
        }
    }


}
