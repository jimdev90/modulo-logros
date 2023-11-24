<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\UnidadUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadUserController extends Controller
{
    public function index()
    {
        $users = UnidadUser::get();
        $unidades = Unidad::get();
        return view('users.index', compact('users', 'unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'idusuarios' => ['required'],
            'id_unidad' => ['required', Rule::exists('unidades', 'id')],
        ]);

        $user = UnidadUser::where('idusuarios', $request->idusuarios)->first();
        if ($user){
            return redirect()->back();
        }

        UnidadUser::create([
            'idusuarios' => $request->idusuarios,
            'id_unidad' => $request->id_unidad,
            'state' => 'active',
            'user_create' => auth()->user()->idusuarios,
        ]);

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $request->validate([
           'cip' => ['required']
        ]);

        $user = User::select('idusuarios', 'nombre')->where('idusuarios', $request->cip)->where('estado', 1)->first();
        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'No se encontró al usuario'
            ], 402);
        }

        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'data' => $user
        ]);
    }

    public function inactive(UnidadUser $user)
    {
        $user->state = 'inactive';
        $user->user_update = auth()->user()->idusuarios;
        $user->save();
        return redirect()->back();
    }

    public function active(UnidadUser $user)
    {
        $user->state = 'active';
        $user->user_update = auth()->user()->idusuarios;
        $user->save();
        return redirect()->back();
    }

}
