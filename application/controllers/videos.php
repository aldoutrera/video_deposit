<?php

class Videos_Controller extends Base_Controller {

    public static $timestamps = true;

    public function __construct()
    {
        $this->filter('before', 'post')
            ->only(array('add', 'update', 'delete'));
    }

    public function action_index()
    {
        return View::make('videos.index');
    }

    public function action_new()
    {
        return View::make('videos.new', array(
            'video' => new Video,
            'action' => 'add',
        ));
    }

    public function action_add()
    {
        if (! $video_data = Video::validate(Input::get('video-url'))) {
            return Redirect::to('/videos/new')
                ->with('status', View::make('partials.fancy-status', array(
                    'type' => 'error',
                    'message' => 'Not a valid video.',
                )));
        }

        $user = User::find_or_create($video_data->author_name);

        if (Video::store(new Video, $video_data, $user)) {
            $type = 'success';
            $message = 'Video added.';
        } else {
            $type = 'error';
            $message = 'Couldn\'t save the video.';
        }
        return Redirect::to('/videos')
            ->with('status', View::make('partials.fancy-status', array(
                'type' => 'success',
                'message' => 'Video added.',
            )));
    }

    public function action_update($id = null)
    {
        if (! $video = Video::find($id)) {
            return Redirect::to('/videos')
                ->with('status', View::make('partials.fancy-status', array(
                    'type' => 'error',
                    'message' => 'Not a valid video id.',
                )));
        }

        if (! $video_data = Video::validate(Input::get('video-url'))) {
            return Redirect::to('/videos/edit/' . $id)
                ->with('status', View::make('partials.fancy-status', array(
                    'type' => 'error',
                    'message' => 'Not a valid video. Please, try again.',
                )));
        }

        $user = User::find_or_create($video_data->author_name);

        if (Video::store($video, $video_data, $user)) {
            $type = 'success';
            $message = 'Video updated.';
        } else {
            $type = 'error';
            $message = 'Couldn\'t update the video.';
        }
        return Redirect::to('/videos')
            ->with('status', View::make('partials.fancy-status', array(
                'type' => 'success',
                'message' => 'Video updated.',
            )));
    }

    public function action_view($id = null) {
        $video = Video::find($id);
        if ($video) {
            $video->views_count++;
            $video->save();
            return View::make('videos.view', array(
                'video' => $video,
            ));
        } else {
            return Redirect::to('/videos');
        }
    }

    public function action_edit($id = null) {
        $video = Video::find($id);
        if ($video) {
            return View::make('videos.edit', array(
                'video' => $video,
                'action' => 'update/' . $id,
            ));
        } else {
            return Redirect::to('/videos');
        }
    }

    public function action_delete($id = null)
    {
        $video = Video::find($id);
        if ($video) {
            if ($video->delete()) {
                $type = 'success';
                $message = 'Video deleted.';
            } else {
                $type = 'error';
                $message = 'Unable to delete de Video.';
            }
            return Redirect::to('/videos')
                ->with('status', View::make('partials.fancy-status', array(
                    'type' => $type,
                    'message' => $message,
                )));
        } else {
            return Redirect::to('/videos')
                ->with('status', View::make('partials.fancy-status', array(
                    'type' => 'error',
                    'message' => 'Invalid id.',
                )));
        }
    }

    public function action_get_titles()
    {
        $key = 'videos-title-' . Input::get('search_input');
        Cache::forget($key);
        $titles = Cache::remember($key, function() {
            return Video::where('title', 'like', '%' . Input::get('search_input') . '%')
                ->get();
        }, 10);
        if (empty($titles)) {
            return false;
        }
        foreach($titles as $title) {
           $titles_vector[] = $title->title;
        }
        return json_encode($titles_vector);
    }

    public function action_get_videos()
    {
        $title = Input::get('title');
        $order = Input::get('order');
        $key = 'videos-list-' . $order . '-' . Input::get('page') . '-' . $title;
        Cache::forget($key);
        $videos = Cache::remember($key, function() {
            return Video::with('user')
                ->where('title', 'like', '%' . Input::get('title') . '%')
                ->order_by('id', Input::get('order'))
                ->paginate(4);
        }, 10);
        return View::make('ajax.videos', array(
            'videos' => $videos->results,
            'links' => $videos->links(),
        ));
    }
}
