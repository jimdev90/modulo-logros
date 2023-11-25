<?php

namespace App\Http\Controllers;


use App\Models\UnidadReporte;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        $dateNow = now()->format('Y-m-d');
        $dateNext = date("Y-m-d", strtotime($dateNow . "+ 1 days"));
        $unidadReporte = UnidadReporte::where('date_init', $dateNow. ' 06:00:00')
            ->where('date_finish', $dateNext. ' 05:59:59')
            ->where('id_unidad', auth()->user()->unidad_usuario->id)->first();
        return view('home', compact('dateNow', 'dateNext', 'unidadReporte'));
    }

    public function initReport(Request $request)
    {
        $unidadReporte = UnidadReporte::create([
            'id_unidad' => $request->id_unidad,
            'date_init' => $request->date_now,
            'date_finish' => $request->date_next,
            'user_init' => auth()->user()->idusuarios,
        ]);

        return redirect()->back();
    }

    public function finishReport(Request $request)
    {
        $unidadReporte = UnidadReporte::where('id', $request->id_unidad_reporte)->first();
        $unidadReporte->status = 2;
        $unidadReporte->user_finish = auth()->user()->idusuarios;
        $unidadReporte->save();
        return redirect()->back();
    }

}
