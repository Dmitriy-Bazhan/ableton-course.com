<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public function comment()
    {
        return $this->hasOne('App\Forum_comment', 'forum_id', 'id');
    }
}
