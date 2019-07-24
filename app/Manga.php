<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    public function volumes() {
        return $this->hasMany(Volume::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
