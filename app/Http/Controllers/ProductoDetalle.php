<?php

namespace App\Http\Controllers;

use App\Models\sf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Detalles;
use App\Models\Producto;
use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

class ProductoDetalle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detalles($idproducto)
    {
        $detalles = Producto::find($idproducto);

        $producto = DB::table('tbl_productos')
            ->join('tbl_categoria', 'tbl_productos.categoria', '=', 'tbl_categoria.idcategoria')
            ->join('tbl_marca', 'tbl_productos.marca', '=', 'tbl_marca.idmarca')
            ->where('idproducto', $idproducto)
            ->first();
        return view('modulos.detalles', compact('producto', 'idproducto','detalles'));
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
        //
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

}
