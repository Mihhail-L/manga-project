<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getUser() {
        $volume = $this->user_id;
        $user = User::find($volume);
        return $user;
    }

    public function volumes() {
        return $this->belongsTo(Volume::class);
    }
}
