<?php

namespace App\Http\Requests;

use App\Models\Show;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PosterFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'poster_url' => ['url', 'nullable'],
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
            $this->persistFromUrl($poster, $show);
        }
        if ($poster['type'] === 'file') {
            $this->persistFromFile($poster, $show);
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
        } catch (FileCannotBeAdded $exception) {
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
        } catch (FileCannotBeAdded $exception) {
            // is in fact an UnreachableUrl exception
            flash("Erreur réseau lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Veuillez réessayer.")->error();
        }
        return $show;
    }
}
