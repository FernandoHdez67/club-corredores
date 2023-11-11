<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_productos";
    protected $primaryKey = "idproducto";
    protected $fillable = [
        'nombre', 'precio', 'categoria', 'marca', 'cantidad', 'descripcion', 'imagen'
    ];

    // Relación con la tabla tbl_categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'idcategoria');
    }

    // Relación con la tabla tbl_marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca', 'idmarca');
    }
}
