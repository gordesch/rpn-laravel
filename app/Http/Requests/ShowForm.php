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
            $ticketing_provider_id_rule = 'string|max:255|unique:shows,ticketing_provider_id,' . $this->route('show')->id . '|nullable';
        } else {
            // Create operation. There is no ID yet.
            $slug_rule = 'required|string|max:255|unique:shows,slug';
            $ticketing_provider_id_rule = 'string|max:255|unique:shows,ticketing_provider_id';
        }
        return [
            'title' => 'required|string|max:255',
            'slug' => $slug_rule,
            'ticketing_provider_id' => $ticketing_provider_id_rule,
            'genre' => 'string|max:255|nullable',
            'duration_in_seconds' => 'numeric|nullable',
            'country' => 'string|max:255|nullable',
            'original_language' => 'boolean|nullable',
            'year' => 'numeric|nullable',
            'director' => 'string|max:255|nullable',
            'cast' => 'string|max:255|nullable',
            'synopsis' => 'string|nullable',
            'audience' => 'in:0,1,2,3,4,5,6,7,8,9,10,11,12,16,18|nullable',
        ];
    }

    public function persist(): Show {
        return Show::create($this->only((new Show)->getFillable()));;
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
        $this->merge([
            'is_local_language' => $this->has('is_local_language'),
        ]);
    }


}
