<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barzelletta extends Model
{
    protected $fillable = array('barzelletta','autores_id');

    public function autores() {
        return $this->belongsTo('App\Autore');
    }
}
