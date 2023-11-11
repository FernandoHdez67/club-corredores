<?php

namespace App\Http\Controllers;

use App\Models\sf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorias(Request $request)
    {
        $texto = trim($request->get('texto'));
        $categoria = DB::table('tbl_categoria')
            ->select('idcategoria', 'categoria', 'imagencat')
            ->where('categoria', 'LIKE', '%' . $texto . '%')
            ->paginate(30);

        return view('admin.admin_categoria', compact('categoria', 'texto'));
    }

    public function listacategorias()
    {
        $categorias = Categoria::all();
        $categoriaFormateados = [];

        foreach ($categorias as $categoria) {
            $imagenNombre = $categoria->imagencat; // Obtener el nombre de la imagen
            $imagenRuta = url('imgcategorias/' . $imagenNombre); // Obtener la URL completa de la imagen
            $categoriaFormateado = [
                'categoria'=>$categoria->categoria,
                'imagencat' => $imagenRuta,
            ];
            $categoriaFormateados[] = $categoriaFormateado;
        }

        // Devolver los servicios formateados como respuesta
        return response()->json($categoriaFormateados);
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
        $request->validate([
            'categoria' => 'required',
            'imagencat' => 'required|image|max:10240', // máximo 10 MB
        ], [
            'categoria.required' => 'La categoria del producto es obligatoria.',
            'imagencat.required' => 'Debe seleccionar una imagen.',
            'imagencat.image' => 'El archivo seleccionado debe ser una imagen.',
            'imagencat.max' => 'El tamaño máximo de la imagen es 10 MB.',
        ]);

        $imagencat = $request->file('imagencat');
        $nombre_imagen = uniqid() . '.' . $imagencat->getClientOriginalExtension();
        $imagencat->move(public_path('imgcategorias'), $nombre_imagen);

        $categoria = Categoria::create([
            'categoria' => $request->categoria,
            'imagencat' => $nombre_imagen,
        ]);

        $texto = trim($request->get('texto'));
        $categoria = DB::table('tbl_categoria')
            ->select('idcategoria', 'categoria', 'imagencat')
            ->orderBy('categoria', 'asc')
            ->paginate(30);


        return view('admin.admin_categoria', compact('categoria'));
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
    public function edit($idcategoria)
    {
        $categoria = Categoria::findOrFail($idcategoria);
        return view('admin.editar_categoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $idcategoria)
    {
        $request->validate([
            'categoria' => 'required',
        ], [
            'categoria.required' => 'La categoria del producto es obligatoria.',
            'imagencat.required' => 'Debe seleccionar una imagen.',
            'imagencat.image' => 'El archivo seleccionado debe ser una imagen.',
            'imagencat.max' => 'El tamaño máximo de la imagen es 10 MB.',
        ]);

        if ($request->hasFile('imagencat')) {
            // Borramos la imagen anterior si existe
            if ($idcategoria->imagencat) {
                Storage::delete('public/imgcategorias/' . $idcategoria->imagencat);
            }

            // Guardamos la nueva imagen en el sistema de archivos
            $imageName = time() . '.' . $request->file('imagencat')->getClientOriginalExtension();
            $request->file('imagencat')->move(public_path('imgcategorias'), $imageName);
            $idcategoria->imagencat = $imageName;
        }

        // Actualizamos el resto de los campos
        $idcategoria->categoria = $request->input('categoria');
        $idcategoria->save();

        return redirect()->route('categorias');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcategoria)
    {


        $categoria = Categoria::find($idcategoria);

        if (!$categoria) {
            abort(404);
        }

        // Eliminar la imagen asociada con el producto
        $imagen_path = public_path('imgcategorias/' . $categoria->imagencat);
        if (file_exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Eliminar el producto
        $categoria->delete();

        return redirect()->route('categorias');
    }
}
