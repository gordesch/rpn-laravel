<?php

namespace App\Http\Requests;

use App\Services\ShowsProvider\Facade\ShowsProvider;
use App\Models\Show;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ShowFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255',
                Rule::unique('shows')->ignore($this->show),
            ],
            'ticketing_provider_id' => ['string', 'max:255',
                Rule::unique('shows')->ignore($this->show),
            ],
            'genre' => ['string', 'max:255', 'nullable'],
            'duration_in_seconds' => ['numeric', 'nullable'],
            'country' => ['string', 'max:255', 'nullable'],
            'original_language' => ['boolean', 'nullable'],
            'year' => ['numeric', 'nullable'],
            'director' => ['string', 'max:255', 'nullable'],
            'cast' => ['string', 'max:255', 'nullable'],
            'synopsis' => ['string', 'nullable'],
            'audience' => ['in:0,1,2,3,4,5,6,7,8,9,10,11,12,16,18', 'nullable'],
        ];
    }

    public function persist(?Show $show = null): Show
    {
        if ($show) {
            $show->update($this->onlyFillable());
            return $show;
        }
        return Show::create($this->onlyFillable());
    }

    public function synchronize(Show $show): Show
    {
        $show = ShowsProvider::synchronize($show);
        $attributes = $this->onlyFillable($show->toArray());
        $show->update($attributes);
        return $show;
    }

    protected function prepareForValidation(): void
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
    protected function onlyFillable(array $attributes = []): array
    {
        if ($attributes) {
            return Arr::only($attributes, (new Show())->getFillable());
        }
        return $this->only((new Show())->getFillable());
    }
}
