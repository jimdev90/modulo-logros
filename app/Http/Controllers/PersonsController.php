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
        $data = Person::whereBetween('created_at', [$dateNow . ' 05:00:00', $dateNext . ' 04:59:59'])
            ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->get();
        $dataCount = [
            "detenidos_extranjero" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 1)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_nacional" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 2)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_terrorismo" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 3)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "detenidos_tid" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 4)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "capturas_rq" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 5)
                ->where('cod_uni1', auth()->user()->unidad_usuario->id_unidad)->sum('quantity'),
            "menores_retenidos" => Person::whereBetween('created_at', [$dateNow . ' 06:00:00', $dateNext . ' 05:59:59'])
                ->where('id_type_person', 6)
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

    public function edit(Person $data)
    {
        return view('logros.edit-item-person', compact('data'));
    }

    public function update(Request $request, Person $data)
    {
        $request->validate([
            'quantity' => 'numeric'
        ]);

        $data->quantity = $request->quantity;
        $data->save();

        return redirect()->route('report.preview-general', ['date' => $data->date_create, 'type_report' => 'excel']);
    }

    public function delete(Person $data)
    {
        $data->user_delete = auth()->user()->idusuarios;
        $data->save();
        $data->delete();
        return redirect()->back();
    }
}
