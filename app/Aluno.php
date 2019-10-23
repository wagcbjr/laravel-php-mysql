<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['name'];

    public function notas()
    {
        return $this->hasMany('App\Nota');
    }

}
