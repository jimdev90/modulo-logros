<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function crearlogro(Request $request)
    {
//dd($request);
        $fechahora = Carbon::now();
        $fecha = $fechahora->toDateString();
        $hora = $fechahora->toTimeString();

        // dd($request->all());
        $resolverStore = DB::connection('mysql')->table('logros_inteligencia')
            ->insert([
                'organizaciones_criminales' => $request->organizacionescriminales,
                'bandas_desarticuladas' => $request->bandasdesarticuladas,
                'detenidos_terrorismo' => $request->detenidosterrorismo,
                'detenidos_tid' =>  $request->detenidostid,
                'detenidos_nacionales' => $request->detenidosnacional,
                'detenidos_extranjeros' => $request->detenidosextranjeros,
                'capturados_rq' => $request->capturadosrq,
                'menores_retenidos' => $request->menoresretenidos,
                'bienes_muebles_incautados' => $request->mueblesincautados,
                'madera' =>  $request->madera,
                'moneda_nacional_incautada' => $request->monedanacional,
                'mercaderia_contrabando' => $request->mercaderia,
                'combustible' => $request->combustible,
                'clorhidrato' => $request->clorhidrato,
                'pbc' =>  $request->pbc,
                'marihuana' => $request->marihuana,
                'tipo_moneda_extranjera' => $request->monedaextranjera,
                'monto_moneda_extranjera' => $request->montomonedaextranjera,
                'pistola' => $request->pistola,
                'revolver' =>  $request->revolver,
                'fusiles' => $request->fusiles,
                'carabinas' =>  $request->carabinas,
                'carabinas_r15' => $request->carabinasr15,
                'armas_artesanales' => $request->armasartesanales,
                'municion_incautada' => $request->municionincautada,
                'hora_reg' => $hora,
                'fecha_reg' => $fecha,
                'usuario_reg' =>  '32083114',
                'estado' => '1',
            ]);
        toastr()->success('Registro Exitoso!', 'Congrats');
        return redirect()->back();
    }
}
