<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autore extends Model
{
    //
    public function barzellette() {
        return $this->hasMany('App\Barzelletta');
    }
}
