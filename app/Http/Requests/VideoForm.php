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
        Collection $request
    ): Video {
        $video->is_original_version = $is_original_version;
        $video->youtube_id =
            $video->is_original_version
            ? $request->get('video-original')
            : $request->get('video-dubbed');

        return $show->videos()->save($video);
    }
}
