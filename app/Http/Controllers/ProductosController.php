<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sf;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function product()
    {
        return view('admin.insertar_producto');
    }



    public function marcacategoria(Request $request, $idproducto = null)
    {
        $marca = Marca::all();
        $categoria = Categoria::all();
        $producto = null;

        if ($idproducto) {
            $producto = DB::table('tbl_productos')->where('idproducto', $idproducto)->first();
        }

        return view('admin.insertar_producto', ['marca' => $marca, 'categoria' => $categoria, 'producto' => $producto]);
    }

    public function productosad(Request $request)
    {
        $texto = trim($request->get('texto'));
        $productos = DB::table('tbl_productos')
            ->select('idproducto', 'nombre', 'precio', 'tbl_categoria.categoria as categoria', 'tbl_marca.marca as marca', 'cantidad', 'descripcion', 'imagen')
            ->leftJoin('tbl_categoria', 'tbl_productos.categoria', '=', 'tbl_categoria.idcategoria')
            ->leftJoin('tbl_marca', 'tbl_productos.marca', '=', 'tbl_marca.idmarca')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('precio', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_categoria.categoria', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_marca.marca', 'LIKE', '%' . $texto . '%')
            ->orWhere('cantidad', 'LIKE', '%' . $texto . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $texto . '%')
            ->orderBy('nombre', 'asc')
            ->paginate(10);

        return view('admin.productos_admin', compact('productos', 'texto'));
    }

    public function productos(Request $request)
    {
        $texto = trim($request->get('texto'));
        $productos = DB::table('tbl_productos')
            ->select('idproducto', 'nombre', 'precio', 'tbl_categoria.categoria', 'tbl_marca.marca', 'cantidad', 'descripcion', 'imagen')
            ->leftJoin('tbl_categoria', 'tbl_productos.categoria', '=', 'tbl_categoria.idcategoria')
            ->leftJoin('tbl_marca', 'tbl_productos.marca', '=', 'tbl_marca.idmarca')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('precio', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_categoria.categoria', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_marca.marca', 'LIKE', '%' . $texto . '%')
            ->orWhere('cantidad', 'LIKE', '%' . $texto . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $texto . '%')
            ->orderBy('nombre', 'asc')
            ->paginate(30);

        $categoria = Categoria::all();
        $marca = Marca::all();

        return view('modulos.productos', compact('productos', 'categoria', 'marca', 'texto'));
    }

    public function buscar(Request $request)
    {
        $texto = trim($request->get('texto'));
        $ordenar = $request->get('ordenar');

        $categoria = Categoria::all();
        $marca = Marca::all();

        $productos = DB::table('tbl_productos')
            ->select('idproducto', 'nombre', 'precio', 'tbl_categoria.categoria', 'tbl_marca.marca', 'cantidad', 'descripcion', 'imagen')
            ->leftJoin('tbl_categoria', 'tbl_productos.categoria', '=', 'tbl_categoria.idcategoria')
            ->leftJoin('tbl_marca', 'tbl_productos.marca', '=', 'tbl_marca.idmarca')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('precio', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_categoria.categoria', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_marca.marca', 'LIKE', '%' . $texto . '%')
            ->orWhere('cantidad', 'LIKE', '%' . $texto . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $texto . '%')
            ->orderByRaw($ordenar === 'precio_asc' ? 'precio ASC' : 'precio DESC')
            ->paginate(30);

        return view('modulos.productos', compact('productos', 'texto', 'ordenar', 'categoria', 'marca'));
    }


    public function buscardos(Request $request)
    {
        $categoria = $request->input('categoria');
        $marca = $request->input('marca');

        // Realizar la consulta a la base de datos para obtener los productos
        // que correspondan a la categoría o marca seleccionada.
        $productos = Producto::when($categoria, function ($query, $categoria) {
            return $query->where('categoria', $categoria);
        })
            ->when($marca, function ($query, $marca) {
                return $query->where('marca', $marca);
            })
            ->get();

        $categoria = Categoria::all();
        $marca = Marca::all();
        // Retornar la vista con los resultados de la búsqueda.
        return view('modulos.productos', compact('productos', 'categoria', 'marca'));
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
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required',
            'marca' => 'required',
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|max:10240', // máximo 10 MB
        ], [
            'nombre.required' => 'El Nombre del producto es obligatorio.',
            'precio.required' => 'El Precio del producto es obligatorio.',
            'precio.numeric' => 'El Precio del producto debe ser un número.',
            'precio.min' => 'El Precio debe ser mayor o igual a cero.',
            'categoria.required' => 'La categoria del producto es obligatoria.',
            'marca.required' => 'La marca del producto es obligatoria.',
            'cantidad.required' => 'La Cantidad es obligatoria.',
            'cantidad.integer' => 'La Cantidad debe ser un número entero.',
            'cantidad.min' => 'La Cantidad debe ser mayor o igual a cero.',
            'descripcion.required' => 'La Descripcion es obligatoria.',
            'imagen.required' => 'Debe seleccionar una imagen.',
            'imagen.image' => 'El archivo seleccionado debe ser una imagen.',
            'imagen.max' => 'El tamaño máximo de la imagen es 10 MB.',
        ]);

        $imagen = $request->file('imagen');
        $nombre_imagen = uniqid() . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('img/productos'), $nombre_imagen);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'categoria' => $request->categoria,
            'marca' => $request->marca,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
            'imagen' => $nombre_imagen,
        ]);

        $texto = trim($request->get('texto'));
        $productos = DB::table('tbl_productos')
            ->select('idproducto', 'nombre', 'precio', 'tbl_categoria.categoria', 'tbl_marca.marca', 'cantidad', 'descripcion', 'imagen')
            ->leftJoin('tbl_categoria', 'tbl_productos.categoria', '=', 'tbl_categoria.idcategoria')
            ->leftJoin('tbl_marca', 'tbl_productos.marca', '=', 'tbl_marca.idmarca')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('precio', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_categoria.categoria', 'LIKE', '%' . $texto . '%')
            ->orWhere('tbl_marca.marca', 'LIKE', '%' . $texto . '%')
            ->orWhere('cantidad', 'LIKE', '%' . $texto . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $texto . '%')
            ->orderBy('nombre', 'asc')
            ->paginate(10);

        return view('admin.productos_admin', compact('productos'))->with('success', 'El producto ha sido creado con éxito.');
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
    public function edit($idproducto)
    {
        $producto = Producto::find($idproducto);
        $marca = Marca::all();
        $categoria = Categoria::all();

        return view('admin.editar_producto', compact('producto', 'marca', 'categoria'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $idproducto)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required',
            'marca' => 'required',
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'required|string', // máximo 10 MB
        ], [
            'nombre.required' => 'El Nombre del producto es obligatorio.',
            'precio.required' => 'El Precio del producto es obligatorio.',
            'precio.numeric' => 'El Precio del producto debe ser un número.',
            'precio.min' => 'El Precio debe ser mayor o igual a cero.',
            'categoria.required' => 'La categoria del producto es obligatoria.',
            'marca.required' => 'La marca del producto es obligatoria.',
            'cantidad.required' => 'La Cantidad es obligatoria.',
            'cantidad.integer' => 'La Cantidad debe ser un número entero.',
            'cantidad.min' => 'La Cantidad debe ser mayor o igual a cero.',
            'descripcion.required' => 'La Descripcion es obligatoria.',
            'imagen.required' => 'Debe seleccionar una imagen.',
            'imagen.image' => 'El archivo seleccionado debe ser una imagen.',
            'imagen.max' => 'El tamaño máximo de la imagen es 10 MB.',
        ]);

        if ($request->hasFile('imagen')) {
            // Borramos la imagen anterior si existe
            if ($idproducto->imagen) {
                Storage::delete('public/img/productos' . $idproducto->imagen);
            }

            // Guardamos la nueva imagen en el sistema de archivos
            $imageName = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('img/productos'), $imageName);
            $idproducto->imagen = $imageName;
        }

        // Actualizamos el resto de los campos
        $idproducto->nombre = $request->input('nombre');
        $idproducto->precio = $request->input('precio');
        $idproducto->categoria = $request->input('categoria');
        $idproducto->marca = $request->input('marca');
        $idproducto->cantidad = $request->input('cantidad');
        $idproducto->descripcion = $request->input('descripcion');
        $idproducto->save();

        return redirect()->route('productoss');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sf  $sf
     * @return \Illuminate\Http\Response
     */
    public function destroy($idproducto)
    {


        $producto = Producto::find($idproducto);

        if (!$producto) {
            abort(404);
        }

        // Eliminar la imagen asociada con el producto
        $imagen_path = public_path('img/productos/' . $producto->imagen);
        if (file_exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Eliminar el producto
        $producto->delete();

        return redirect()->route('productoss');
    }


    public function eliminarVarios(Request $request)
    {
        $idproducto = $request->input('eliminar', []);

        if (empty($idproducto)) {
            return back()->with('error', 'No se han seleccionado productos para eliminar.');
        }

        $productos = Producto::whereIn('idproducto', $idproducto)->get();

        foreach ($productos as $producto) {
            $ruta_imagen = public_path('img/productos/' . $producto->imagen);
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
            $producto->delete();
        }

        return redirect()->route('productoss');
    }
}
