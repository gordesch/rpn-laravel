<?php

namespace App\Http\Requests;

use App\Show;
use Illuminate\Foundation\Http\FormRequest;

class PosterForm extends FormRequest
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
            //
        ];
    }

    public function persist(
        array $poster,
        Show $show
    ) {
        if ($poster['type'] === 'file') {
            return $show
                ->addMedia($poster['location'])
                ->usingName($show->slug)
                ->toMediaCollection('posters');
        } else {
            try {
                $show = $show
                    ->addMediaFromUrl($poster['location'])
                    ->usingName($show->slug)
                    ->toMediaCollection('posters');
            } catch (Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl $e) {
                flash("Erreur lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Veuillez réessayer.")->error();
            }

            return $show;
        }
    }
}
