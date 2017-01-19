<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barzelletta extends Model
{
    //
    public function autores() {
        return $this->belongsTo('App\Autore');
    }
}
