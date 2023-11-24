<?php

namespace App\Http\Controllers;

use App\Models\CriminalGroup;
use App\Models\TypeCriminalGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CriminalGroupController extends Controller
{
    public function index()
    {
        $data = CriminalGroup::where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "organizacion_criminal" => CriminalGroup::where('id_type_criminal_group', 1)
                                        ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "banda_criminal" => CriminalGroup::where('id_type_criminal_group', 2)
                                        ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeCriminalGroup::get();
        return view('logros.criminal-groups', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_criminal_group' => ['required', Rule::exists('types_criminal_group', 'id')],
            'quantity'  => ['required', 'numeric', 'min:1'],
        ]);

        CriminalGroup::create([
            'id_type_criminal_group' => $request->id_type_criminal_group,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(CriminalGroup $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
