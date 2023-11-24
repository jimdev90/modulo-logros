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
use Illuminate\Support\Facades\DB;
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
        $dateNext = date("Y-m-d", strtotime($date. "+ 1 days"));
        $id_unidad = $request->id_unidad;
        $type_report = $request->type_report;
        $unidad = Unidad::where('id', $request->id_unidad)->first();
        $criminalGroups = CriminalGroup::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)
            ->get();

        $currencies = Currency::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $drugs = Drug::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $explosives = Explosive::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $firearms = FireArm::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $fuels = Fuel::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $others = Other::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $persons = Person::whereBetween('created_at', [$date. ' 05:00:00', $dateNext. ' 04:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();

        $dataCountCriminalGroups = DB::select('CALL PA_GET_REPORT_CRIMINAL_GROUP_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountCurrencies = DB::select('CALL PA_GET_REPORT_CURRENCY_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountDrug = DB::select('CALL PA_GET_REPORT_DRUG_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountExplosives = DB::select('CALL PA_GET_REPORT_EXPLOSIVE_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountFireArms = DB::select('CALL PA_GET_REPORT_FIREARM_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountFuels = DB::select('CALL PA_GET_REPORT_FUEL_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountOthers = DB::select('CALL PA_GET_REPORT_OTHER_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountPersons = DB::select('CALL PA_GET_REPORT_PERSON_DATE_UNIDAD(?, ?)', array($date, $id_unidad));


        return view('reports.preview', compact('criminalGroups', 'currencies', 'drugs', 'explosives', 'firearms', 'fuels', 'others', 'persons', 'date', 'dateNext', 'unidad', 'id_unidad', 'type_report', 'dataCountCriminalGroups', 'dataCountPersons', 'dataCountFuels', 'dataCountCurrencies', 'dataCountFireArms', 'dataCountExplosives', 'dataCountOthers'));
    }

    public function export(Request $request)
    {
        $date = $request->date;
        $dateNext = $request->date_next;
        $id_unidad = $request->id_unidad;
        $unidad = Unidad::where('id', $id_unidad)->first();

        $dataCountCriminalGroups = DB::select('CALL PA_GET_REPORT_CRIMINAL_GROUP_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountCurrencies = DB::select('CALL PA_GET_REPORT_CURRENCY_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountDrug = DB::select('CALL PA_GET_REPORT_DRUG_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountExplosives = DB::select('CALL PA_GET_REPORT_EXPLOSIVE_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountFireArms = DB::select('CALL PA_GET_REPORT_FIREARM_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountFuels = DB::select('CALL PA_GET_REPORT_FUEL_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountOthers = DB::select('CALL PA_GET_REPORT_OTHER_DATE_UNIDAD(?, ?)', array($date, $id_unidad));
        $dataCountPersons = DB::select('CALL PA_GET_REPORT_PERSON_DATE_UNIDAD(?, ?)', array($date, $id_unidad));

        return Excel::download(new LogrosExport(
            $dataCountCriminalGroups,
            $dataCountCurrencies,
            $dataCountDrug,
            $dataCountExplosives,
            $dataCountFireArms,
            $dataCountFuels,
            $dataCountOthers,
            $dataCountPersons,
            $date,
            $dateNext,
            $unidad
        ), 'logros.xlsx');
    }
}
