<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    public function disciplina (){
        return $this->belongsTo('App\Disciplina');
    }
}
