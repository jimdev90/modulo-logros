<?php

namespace App\Http\Controllers;

use App\Exports\LogrosGeneralExport;
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
use App\Models\UnidadReporte;
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

    public function processGeneral(Request $request)
    {
        $request->validate([
            "date" => "required",
            "type_report" => "required"
        ]);
        //Ingresamos auditoria del usuario que desea ver el preview general

        return redirect()->route('report.preview-general', ['date' => $request->date, 'type_report' => $request->type_report]);
    }

    public function preview(Request $request)
    {
        $date = $request->date;
        $dateNext = date("Y-m-d", strtotime($date. "+ 1 days"));
        $id_unidad = $request->id_unidad;
        $type_report = $request->type_report;
        $unidad = Unidad::where('id', $request->id_unidad)->first();

        $criminalGroups = CriminalGroup::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)
            ->get();
        $currencies = Currency::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $drugs = Drug::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $explosives = Explosive::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $firearms = FireArm::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $fuels = Fuel::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $others = Other::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->where('cod_uni1', $request->id_unidad)->get();
        $persons = Person::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
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

    public function previewGeneral(Request $request)
    {
        $date = $request->date;
        $dateNext = date("Y-m-d", strtotime($date. "+ 1 days"));

        $unidadesRegistro = UnidadReporte::select('id_unidad')->where('date_init', $date. ' 06:00:00')
            ->where('date_finish', $dateNext. ' 05:59:59')
            ->groupBy('id_unidad')
            ->get()
            ->pluck('id_unidad');

        $unidadesRegistroArray = $unidadesRegistro->toArray();

        $criminalGroups = CriminalGroup::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $currencies = Currency::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $drugs = Drug::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $explosives = Explosive::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $firearms = FireArm::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $fuels = Fuel::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();
        $others = Other::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();

        $persons = Person::whereBetween('created_at', [$date. ' 06:00:00', $dateNext. ' 05:59:59'])
            ->whereIn('cod_uni1', $unidadesRegistroArray)
            ->get();

        $unidadesRegistroArrayValue = implode(',', $unidadesRegistroArray);

        $dataCountCriminalGroups = DB::select("CALL PA_GET_REPORT_CRIMINAL_GROUP_DATE_GENERAL(?, ?)", array($date, $unidadesRegistroArrayValue));
        $dataCountCurrencies = DB::select('CALL PA_GET_REPORT_CURRENCY_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountDrug = DB::select('CALL PA_GET_REPORT_DRUG_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountExplosives = DB::select('CALL PA_GET_REPORT_EXPLOSIVE_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountFireArms = DB::select('CALL PA_GET_REPORT_FIREARM_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountFuels = DB::select('CALL PA_GET_REPORT_FUEL_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountOthers = DB::select('CALL PA_GET_REPORT_OTHER_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountPersons = DB::select('CALL PA_GET_REPORT_PERSON_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));

        return view('reports.preview-general', compact('criminalGroups', 'currencies', 'drugs', 'explosives', 'firearms', 'fuels', 'others', 'persons', 'date', 'dateNext', 'dataCountCriminalGroups', 'dataCountCurrencies', 'dataCountDrug', 'dataCountExplosives', 'dataCountFireArms', 'dataCountFuels', 'dataCountOthers', 'dataCountPersons', 'unidadesRegistroArrayValue'));
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

    public function exportGeneral(Request $request)
    {
        $date = $request->date;
        $dateNext = $request->date_next;
        $unidades = $request->unidades;

        $unidadesRegistroArrayValue = implode(',', $unidades);

        $dataCountCriminalGroups = DB::select("CALL PA_GET_REPORT_CRIMINAL_GROUP_DATE_GENERAL(?, ?)", array($date, $unidadesRegistroArrayValue));
        $dataCountCurrencies = DB::select('CALL PA_GET_REPORT_CURRENCY_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountDrug = DB::select('CALL PA_GET_REPORT_DRUG_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountExplosives = DB::select('CALL PA_GET_REPORT_EXPLOSIVE_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountFireArms = DB::select('CALL PA_GET_REPORT_FIREARM_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountFuels = DB::select('CALL PA_GET_REPORT_FUEL_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountOthers = DB::select('CALL PA_GET_REPORT_OTHER_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));
        $dataCountPersons = DB::select('CALL PA_GET_REPORT_PERSON_DATE_GENERAL(?, ?)', array($date, $unidadesRegistroArrayValue));

        return Excel::download(new LogrosGeneralExport(
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
        ), "REPORTE_GENERAL_{$date}.xlsx");
    }
}
