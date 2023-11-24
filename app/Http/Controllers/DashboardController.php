<?php

namespace App\Http\Controllers;

use App\Models\UnidadUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = UnidadUser::get();
        return view('dashboard', compact('users'));
    }
}
