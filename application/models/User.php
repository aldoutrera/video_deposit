<?php

class User extends Eloquent
{
    public static $timestamps = false;

    public function videos()
    {
        return $this->has_many('Video')->order_by('id', 'desc');
    }

    public static function find_or_create($name)
    {
        $user = User::where('name', '=', $name)->first();
        if ($user) {
            return $user;
        } else {
            $user = new User;
            $user->name = $name;
            if ($user->save()) {
                return $user;
            } else {
                return false;
            }
        }
    }
}
