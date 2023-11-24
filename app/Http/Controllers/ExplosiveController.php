<?php

namespace App\Http\Controllers;

use App\Models\Explosive;
use App\Models\TypeExplosive;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExplosiveController extends Controller
{
    public function index()
    {
        $data = Explosive::where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "dinamita" => Explosive::where('id_type_explosive', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "artefacto_pirotecnico" => Explosive::where('id_type_explosive', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeExplosive::get();
        return view('logros.explosives', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_explosive' => ['required', Rule::exists('types_explosive', 'id')],
            'quantity' => ['required', 'min:1', 'regex:/^(([0-9]*)(\.([0-9]+))?)$/'],
        ]);

        Explosive::create([
            'id_type_explosive' => $request->id_type_explosive,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Explosive $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
