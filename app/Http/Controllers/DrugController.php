<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\TypeDrug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DrugController extends Controller
{
    public function index()
    {
        $data = Drug::where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();

        $dataCount = [
            "clorhidrato" => [
                'ton' => Drug::where('id_type_drug', 1)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('ton'),
                'kilogram' => Drug::where('id_type_drug', 1)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('kilogram'),
                'gram' => Drug::where('id_type_drug', 1)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('gram'),
            ],
            "pbc" => [
                'ton' => Drug::where('id_type_drug', 2)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('ton'),
                'kilogram' => Drug::where('id_type_drug', 2)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('kilogram'),
                'gram' => Drug::where('id_type_drug', 2)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('gram'),
            ],
            "marihuana" => [
                'ton' => Drug::where('id_type_drug', 3)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('ton'),
                'kilogram' => Drug::where('id_type_drug', 3)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('kilogram'),
                'gram' => Drug::where('id_type_drug', 3)
                    ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('gram'),
            ],
        ];
        $types = TypeDrug::get();
        return view('logros.drugs', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_drug' => ['required', Rule::exists('types_drug', 'id')],
            'ton' => ['nullable', 'min:0', 'numeric'],
            'kilogram' => ['nullable', 'min:0', 'numeric'],
            'gram' => ['required', 'min:0', 'regex:/^(([0-9]*)(\.([0-9]+))?)$/'],
        ]);

        Drug::create([
            'id_type_drug' => $request->id_type_drug,
            'ton' => $request->ton,
            'kilogram' => $request->kilogram,
            'gram' => $request->gram,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Drug $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
