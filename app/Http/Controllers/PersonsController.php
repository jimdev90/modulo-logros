<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\TypePerson;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonsController extends Controller
{
    public function index()
    {
        $data = Person::where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "detenidos_extranjero" => Person::where('id_type_person', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_nacional" => Person::where('id_type_person', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_terrorismo" => Person::where('id_type_person', 3)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_tid" => Person::where('id_type_person', 4)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "capturas_rq" => Person::where('id_type_person', 5)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "menores_retenidos" => Person::where('id_type_person', 6)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
        ];
        $types = TypePerson::get();
        return view('logros.persons', compact('data', 'dataCount', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_type_person' => ['required', Rule::exists('types_person', 'id')],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        Person::create([
            'id_type_person' => $request->id_type_person,
            'quantity' => $request->quantity,
            'date_create' => date('Y-m-d'),
            'time_create' => now()->format('H:i:s'),
            'cod_uni1' => auth()->user()->unidad_usuario->id_unidad,
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function delete(Person $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
