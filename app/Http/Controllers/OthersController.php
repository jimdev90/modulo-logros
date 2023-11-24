<?php

namespace App\Http\Controllers;

use App\Models\Other;
use App\Models\TypeOther;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OthersController extends Controller
{
    public function index()
    {
        $data = Other::where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "bienes_muebles_incautados" => Other::where('id_type_other', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "bienes_inmuebles_incautados" => Other::where('id_type_other', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "madera" => Other::where('id_type_other', 3)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "mercaderia_contrabando" => Other::where('id_type_other', 4)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeOther::get();
        return view('logros.other', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_other' => ['required', Rule::exists('types_other', 'id')],
            'quantity' => ['required', 'min:1', 'regex:/^(([0-9]*)(\.([0-9]+))?)$/'],
        ]);

        Other::create([
            'id_type_other' => $request->id_type_other,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Other $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
