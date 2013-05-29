<?php

class Users_Controller extends Base_Controller
{
    public function action_index() {
        return View::make('users.index');
    }

    public function action_view($id = null)
    {
        $user   = User::find($id);
        if (! $user) {
            Redirect::to('/users');
        }
        $videos = Video::with('user')
                    ->where('user_id', '=', $id)
                    ->order_by('id', 'desc')
                    ->paginate(4);

        return View::make('users.view', array(
            'videos' => $videos->results,
            'links'  => $videos->links(),
            'user'   => $user,
        ));
    }

    public function action_get_users_names()
    {
        $key = 'users-names-' . Input::get('search_input');
        Cache::forget($key);
        $users = Cache::remember($key, function() {
            return User::where('name', 'like', '%' . Input::get('search_input') . '%')
                ->get();
        }, 10);
        if (empty($users)) {
            return false;
        }
        foreach($users as $user) {
           $users_vector[] = $user->name;
        }
        return json_encode($users_vector);
    }

    public function action_get_users()
    {
        $key = 'users-list-' . Input::get('page') . '-' . Input::get('name');
        Cache::forget($key);
        $users = Cache::remember($key, function(){
            return User::with('videos')
                ->where('name', 'like', '%' . Input::get('name') . '%')
                ->paginate(5);
        }, 10);
        return View::make('ajax.users', array(
            'users' => $users->results,
            'links' => $users->links(),
        ));
    }
}
