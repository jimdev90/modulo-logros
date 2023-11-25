<?php

namespace App\Http\Controllers;

use App\Models\FireArm;
use App\Models\TypeFireArm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FireArmsController extends Controller
{
    public function index()
    {
        $dateNow = now()->format('Y-m-d');
        $timeNow = now()->format('H:i:s');
        if ($timeNow < '06:00:00'){
            $dateNow = date('Y-m-d', strtotime($dateNow . '- 1 days'));
        }
        if ($timeNow >= '06:00:00'){
            $dateNow = now()->format('Y-m-d');
        }
        $dateNext = date("Y-m-d", strtotime($dateNow . "+ 1 days"));
        $data = FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
            ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "pistola" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "revolver" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "fusiles" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 3)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "granadas" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 4)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "carabinas" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 5)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "carabinas_mr15" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 6)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "armas_artesanales" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 7)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "municion_incautada" => FireArm::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_firearm', 8)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypeFireArm::get();
        return view('logros.firearms', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_firearm' => ['required', Rule::exists('types_firearm', 'id')],
            'quantity'  => ['required', 'numeric', 'min:1'],
        ]);

        FireArm::create([
            'id_type_firearm' => $request->id_type_firearm,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(FireArm $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
