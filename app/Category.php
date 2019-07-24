<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function mangas() {
        return $this->belongsToMany(Manga::class);
    }
}
