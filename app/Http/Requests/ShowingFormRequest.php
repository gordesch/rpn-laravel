<?php

namespace App\Http\Requests;

use App\Models\Showing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class ShowingFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'ticketing_provider_id' => ['required', 'string', 'max:255'],
            'programming_id' => ['required', 'numeric'],
            'datetime' => ['required', 'date'],
            'preshow_duration_in_seconds' => ['numeric'],
            'is_original_version' => ['required', 'boolean'],
            'is_3d' => ['required', 'boolean'],
            'auditorium_number' => ['required', 'numeric'],
        ];
    }

    public function persist(Showing $showing): void
    {
        Showing::create($showing->only($showing->getFillable()));
    }

    public function persistMultiple(Collection $showings): void
    {
        $fillables = (new Showing())->getFillable();
        Showing::insert(
            $showings->map(
                function (Showing $showing) use ($fillables) {
                    return $showing->only($fillables);
                }
            )->all()
        );
    }
}
