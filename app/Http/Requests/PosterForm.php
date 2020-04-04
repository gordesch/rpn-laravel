<?php

namespace App\Http\Requests;

use App\Show;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PosterForm extends FormRequest
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
            // Here
        ];
    }

    /**
     * @param  array<string>  $poster
     */
    public function persist(
        array $poster,
        Show $show
    ): Show {
        if ($poster['type'] === 'url') {
            return $this->persistFromUrl($poster, $show);
        }
        if ($poster['type'] === 'file') {
            return $this->persistFromFile($poster, $show);
        }
        $show->poster_is_pending = false;
        $show->save();
        return $show;
    }

    private function persistFromUrl(
        array $poster,
        Show $show
    ): Show {
        try {
            $show
                ->addMediaFromUrl($poster['location'])
                ->usingName($show->slug)
                ->toMediaCollection('posters');
            flash("Affiche de <strong>{$show->title}</strong> importée avec succès")->success();
        } catch (FileCannotBeAdded $e) {
            // is in fact an UnreachableUrl exception
            flash("Erreur réseau lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Veuillez réessayer.")->error();
        }
        return $show;
    }

    private function persistFromFile(
        array $poster,
        Show $show
    ): Show {
        try {
            $show
                ->addMediaFromUrl($poster['location'])
                ->usingName($show->slug)
                ->toMediaCollection('posters');
            flash("Affiche de <strong>{$show->title}</strong> importée avec succès")->success();
        } catch (FileCannotBeAdded $e) {
            // is in fact an UnreachableUrl exception
            flash("Erreur réseau lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Veuillez réessayer.")->error();
        }
        return $show;
    }
}
