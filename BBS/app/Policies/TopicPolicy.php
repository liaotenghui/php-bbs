<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
        //用户才有更新权限
        return $topic->user_id == $user->id;
        // return true;
    }

    public function destroy(User $user, Topic $topic)
    {
        return true;
        // return $topic->user_id == $user->id;
    }
}
