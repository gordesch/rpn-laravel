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
     * @param  Show  $show
     *
     * @return Show
     */
    public function persist(
        array $poster,
        Show $show
    ): Show {
        if ($poster['type'] === 'file') {
            try {
                $show
                    ->addMedia($poster['location'])
                    ->usingName($show->slug)
                    ->toMediaCollection('posters');
            } catch (FileDoesNotExist $e) {
                flash("Erreur lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Fichier inexistant.")->error();
            } catch (FileIsTooBig $e) {
                flash("Erreur lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Fichier trop gros.")->error();
            }
            return $show;
        }
        if ($poster['type'] === 'url') {
            try {
                $show
                    ->addMediaFromUrl($poster['location'])
                    ->usingName($show->slug)
                    ->toMediaCollection('posters');
            } catch (FileCannotBeAdded $e) {
                // is in fact an UnreachableUrl exception
                flash("Erreur réseau lors de l'importation de l'affiche de <strong>{$show->title}</strong>. Veuillez réessayer.")->error();
            }
            return $show;
        }
        return $show;
    }
}
