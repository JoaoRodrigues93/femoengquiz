<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    public function perguntas (){
        return $this->hasMany('App\Pergunta');
    }
}
