<?php

namespace App\Http\Controllers;

use App\Models\UnidadReporte;
use App\Models\UnidadUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unidadesConLogros = UnidadReporte::where('status', 1)->get();
        $unidadesSinLogros = UnidadReporte::where('status', 2)->get();
        return view('dashboard', compact('unidadesConLogros', 'unidadesSinLogros'));
    }
}
