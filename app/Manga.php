<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function hasTag($tagid) {
        return in_array($tagid, $this->tags->pluck('id')->toArray());
    }

    public function hasCat($categoryid) {
        return in_array($categoryid, $this->categories->pluck('id')->toArray());
    }
    public function deleteImage() {
        Storage::delete('/storage/'.$this->image);
    }
}
