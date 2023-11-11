<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public function usuarios(Request $request)
    {
        $texto = trim($request->get('texto'));
        $usurarios = DB::table('users')
            ->select('id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at')
            ->where('name', 'LIKE', '%' . $texto . '%')
            ->orWhere('email', 'LIKE', '%' . $texto . '%')
            ->orWhere('email_verified_at', 'LIKE', '%' . $texto . '%')
            ->orWhere('password', 'LIKE', '%' . $texto . '%')
            ->orWhere('remember_token', 'LIKE', '%' . $texto . '%')
            ->orWhere('created_at', 'LIKE', '%' . $texto . '%')
            ->orWhere('updated_at', 'LIKE', '%' . $texto . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);

        return view('admin.usuarios_admin', compact('usurarios', 'texto'));
    }
}
