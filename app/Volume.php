<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    public function manga() {
        return $this->belongsTo(Manga::class);
    }
}
