<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['aluno_id', 'materia', 'nota'];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

}
