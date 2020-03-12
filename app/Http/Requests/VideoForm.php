<?php

namespace App\Http\Requests;

use App\Show;
use App\Video;
use Illuminate\Foundation\Http\FormRequest;

class VideoForm extends FormRequest
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
        Video $video,
        Show $show,
        bool $is_original_version
    ) {
        $video->is_original_version = $is_original_version;
        $video->youtube_id =
            $video->is_original_version
            ? request('video-original')
            : request('video-dubbed');


        return $show->videos()->save($video);
    }
}
