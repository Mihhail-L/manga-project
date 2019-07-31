<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Volume extends Model
{
    public function manga() 
    {
        return $this->belongsTo(Manga::class);
    }
    
    public function deleteImage() 
    {
        Storage::delete('/storage/'.$this->image);
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }
}
