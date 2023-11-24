<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\TypeCurrency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function index()
    {
        $dateNow = now()->format('Y-m-d');
        $dateNext = date("Y-m-d", strtotime($dateNow . "+ 1 days"));
        $data = Currency::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
            ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "nuevos_soles" => Currency::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
                ->where('id_type_currency', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "dolares" => Currency::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
                ->where('id_type_currency', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "euros" => Currency::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
                ->where('id_type_currency', 3)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "pesos" => Currency::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
                ->where('id_type_currency', 4)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeCurrency::get();
        return view('logros.currencies', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_currency' => ['required', Rule::exists('types_currency', 'id')],
            'quantity' => ['required', 'min:1', 'regex:/^(([0-9]*)(\.([0-9]+))?)$/'],
        ]);

        Currency::create([
            'id_type_currency' => $request->id_type_currency,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Currency $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
