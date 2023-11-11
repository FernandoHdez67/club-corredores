<?php

namespace App\Http\Controllers;

use App\Models\sf;
use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function marcas(Request $request)
    {
        $texto = trim($request->get('texto'));
        $marca = DB::table('tbl_marca')
            ->select('idmarca', 'marca')
            ->where('marca', 'LIKE', '%' . $texto . '%')
            ->paginate(30);

        return view('admin.admin_marca', compact('marca', 'texto'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'marca.required' => 'La marca es obligatoria.',
        ];

        $request->validate([
            'marca' => 'required|string',
        ], $messages);


        $marca = Marca::create([
            'marca' => $request->marca,
        ]);

        $marca = Marca::all();
        return view('admin.admin_marca', compact('marca'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function edit($idmarca)
    {
        $marca = Marca::findOrFail($idmarca);
        return view('admin.editar_marca', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $idmarca)
    {
        $messages = [
            'marca.required' => 'La marca es obligatoria.',
        ];

        $request->validate([
            'marca' => 'required|string',
        ], $messages);

        // Actualizamos el resto de los campos
        $idmarca->marca = $request->input('marca');
        $idmarca->save();

        return redirect()->route('marcas');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function destroy($idmarca)
    {


        $marca = Marca::find($idmarca);

        if (!$marca) {
            abort(404);
        }

        // Eliminar la pregunta
        $marca->delete();

        return redirect()->route('marcas');
    }
}
