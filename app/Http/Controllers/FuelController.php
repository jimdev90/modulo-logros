<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\TypeFuel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FuelController extends Controller
{
    public function index()
    {
        $dateNow = now()->format('Y-m-d');
        $timeNow = now()->format('H:i:s');
        if ($timeNow < '06:00:00'){
            $dateNow = date('Y-m-d', strtotime($dateNow . '- 1 days'));
            $dateNext = date("Y-m-d", strtotime($dateNow . "+ 1 days"));
        }
        if ($timeNow >= '06:00:00'){
            $dateNow = now()->format('Y-m-d');
            $dateNext = date("Y-m-d", strtotime($dateNow . "+ 1 days"));
        }
        $data = Fuel::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
            ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "petroleo" => Fuel::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_fuel', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "gasolina" => Fuel::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_fuel', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeFuel::get();
        return view('logros.fuel', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_fuel' => ['required', Rule::exists('types_fuel', 'id')],
            'quantity' => ['required', 'min:1', 'regex:/^(([0-9]*)(\.([0-9]+))?)$/'],
        ]);

        Fuel::create([
            'id_type_fuel' => $request->id_type_fuel,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Fuel $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
