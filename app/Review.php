<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function mangas() {
        return $this->belongsTo(Manga::class);
    }
}
