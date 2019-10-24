<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Nota;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index(Request $request, $id)
    {
        $aluno = Aluno::with('notas')->find($id);
        return $aluno;
    }

    public function store(Request $request, $id)
    {
        if(!$aluno = Aluno::find($id))
            return response()->json(['error' => 'Aluno informado não encontrado'], 404);

        return $aluno->notas()->create($request->all());
    }

    public function show($aluno_id, $nota_id)
    {
        $aluno = Aluno::with(['notas' => function ($query) use ($nota_id) {
            $query->where('id', $nota_id);
        }])->find($aluno_id);

        return $aluno;
    }

    public function update(Request $request, $aluno_id, $nota_id)
    {
        if(!$aluno = Aluno::find($aluno_id))
            return response()->json(['error' => 'Aluno informado não encontrado'], 404);

        if(!$nota = $aluno->notas()->find($nota_id))
            return response()->json(['error' => 'Nota informada não encontrada'], 404);

        $nota->update($request->only('materia', 'nota'));

        return $nota;

    }


    public function destroy($aluno_id, $nota_id)
    {
        if(!$aluno = Aluno::find($aluno_id))
            return response()->json(['error' => 'Aluno informado não encontrado'], 404);

        if(!$nota = $aluno->notas()->find($nota_id))
            return response()->json(['error' => 'Nota informada não encontrada'], 404);

        $nota->delete();

    }
}
