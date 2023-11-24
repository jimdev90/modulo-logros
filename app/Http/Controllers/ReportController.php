<?php

namespace App\Http\Controllers;

use App\Models\CriminalGroup;
use App\Models\Currency;
use App\Models\Drug;
use App\Models\Explosive;
use App\Models\FireArm;
use App\Models\Fuel;
use App\Models\Other;
use App\Models\Person;
use App\Models\TypeCriminalGroup;
use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Exports\LogrosExport;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    public function index()
    {
        $unidades = Unidad::all();
        return view('reports.index', compact('unidades'));
    }

    public function preview(Request $request)
    {
        $date = $request->date;
        $id_unidad = $request->id_unidad;
        $type_report = $request->type_report;
        $unidad = Unidad::where('id', $request->id_unidad)->first();

        $criminalGroups = CriminalGroup::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $currencies = Currency::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $drugs = Drug::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $explosives = Explosive::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $firearms = FireArm::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $fuels = Fuel::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $others = Other::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();
        $persons = Person::where('date_create', $request->date)
            ->where('cod_uni1', $request->id_unidad)->get();

        $dataCountCriminalGroups = [
            "organizacion_criminal" => CriminalGroup::where('id_type_criminal_group', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "banda_criminal" => CriminalGroup::where('id_type_criminal_group', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountPersons = [
            "detenidos_extranjero" => Person::where('id_type_person', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "detenidos_nacional" => Person::where('id_type_person', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "detenidos_terrorismo" => Person::where('id_type_person', 3)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "detenidos_tid" => Person::where('id_type_person', 4)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "capturas_rq" => Person::where('id_type_person', 5)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "menores_retenidos" => Person::where('id_type_person', 6)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountFuels = [
            "petroleo" => Fuel::where('id_type_fuel', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "gasolina" => Fuel::where('id_type_fuel', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountCurrencies = [
            "nuevos_soles" => Currency::where('id_type_currency', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "dolares" => Currency::where('id_type_currency', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "euros" => Currency::where('id_type_currency', 3)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "pesos" => Currency::where('id_type_currency', 4)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountFireArms = [
            "pistola" => FireArm::where('id_type_firearm', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "revolver" => FireArm::where('id_type_firearm', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "fusiles" => FireArm::where('id_type_firearm', 3)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "granadas" => FireArm::where('id_type_firearm', 4)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "carabinas" => FireArm::where('id_type_firearm', 5)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "carabinas_mr15" => FireArm::where('id_type_firearm', 6)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "armas_artesanales" => FireArm::where('id_type_firearm', 7)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "municion_incautada" => FireArm::where('id_type_firearm', 8)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountExplosives = [
            "dinamita" => Explosive::where('id_type_explosive', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "artefacto_pirotecnico" => Explosive::where('id_type_explosive', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        $dataCountOthers = [
            "bienes_muebles_incautados" => Other::where('id_type_other', 1)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "bienes_inmuebles_incautados" => Other::where('id_type_other', 2)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "madera" => Other::where('id_type_other', 3)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
            "mercaderia_contrabando" => Other::where('id_type_other', 4)
                ->where('date_create', $request->date)
                ->where('cod_uni1', $request->id_unidad)->sum('quantity'),
        ];

        return view('reports.preview', compact('criminalGroups', 'currencies', 'drugs', 'explosives', 'firearms', 'fuels', 'others', 'persons', 'date', 'unidad', 'id_unidad', 'type_report', 'dataCountCriminalGroups', 'dataCountPersons', 'dataCountFuels', 'dataCountCurrencies', 'dataCountFireArms', 'dataCountExplosives', 'dataCountOthers'));
    }

    public function export(Request $request)
    {
        return Excel::download([], 'logros.xlsx');
    }
}
