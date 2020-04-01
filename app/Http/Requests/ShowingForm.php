<?php

namespace App\Http\Requests;

use App\Showing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class ShowingForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'ticketing_provider_id' => 'required|string|max:255',
            'programming_id' => 'required|numeric',
            'datetime' => 'required|date',
            'preshow_duration_in_seconds' => 'numeric',
            'is_original_version' => 'required|boolean',
            'is_3d' => 'required|boolean',
            'auditorium_number' => 'required|numeric',
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
                function ($showing) use ($fillables) {
                    return $showing->only($fillables);
                }
            )->all()
        );
    }
}
