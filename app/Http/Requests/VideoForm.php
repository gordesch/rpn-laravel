<?php

namespace App\Http\Requests;

use App\Show;
use App\Video;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class VideoForm extends FormRequest
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
    public function rules()
    {
        return [
            // Rules here
        ];
    }

    public function persist(
        Video $video,
        Show $show,
        bool $is_original_version,
        Collection $input
    ): Video {
        $video->is_original_version = $is_original_version;
        $video->youtube_id =
            $video->is_original_version
            ? $input->get('video-original')
            : $input->get('video-dubbed');
        try {
            $show->videos()->save($video);
            if ($video->is_original_version) {
                flash('Bande-annonce VO ajoutée')->success();
            } elseif (! $video->is_original_version) {
                flash('Bande-annonce VF ajoutée')->success();
            }
        } catch (\Exception $exception) {
            flash('Échec de l\'ajout de bande(s)-annonce(s)')->error();
        }
        return $video;
    }
}
