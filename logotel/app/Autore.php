<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autore extends Model
{
    protected $fillable = array('autore');

    public function barzellette() {
        return $this->hasMany('App\Barzelletta');
    }
}
