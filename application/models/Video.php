<?php

class Video extends Eloquent
{
    public function user()
    {
        return $this->belongs_to('User');
    }

    public static function validate($video_url)
    {
        $base_url          = 'http://www.youtube.com/oembed?url=';
        $format            = '&format=json';
        $encoded_video_url = urlencode($video_url);
        $complete_url      = $base_url . $encoded_video_url . $format;

        if ($content = @file_get_contents($complete_url) === false) {
            return false;
        }

        $video_data = json_decode(file_get_contents($complete_url));

        if (Video::where('title', '=', $video_data->title)->get()) {
            return false;
        }

        $video_data->url = $video_url;

        return $video_data;
    }

    public static function is_unique($video_code)
    {

    }

    public static function store($video_object, $video_data, $user)
    {
        $video_object->title         = $video_data->title;
        $video_object->url           = $video_data->url;
        $video_object->thumbnail_url = $video_data->thumbnail_url;
        $video_object->html          = $video_data->html;
        $video_object->user_id       = $user->id;
        return $video_object->save();
    }

    public function get_created_at()
    {
        return date('M jS Y', strtotime($this->get_attribute('created_at')));
    }

}
