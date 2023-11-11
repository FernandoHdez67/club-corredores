<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // use HasFactory;
   public $timestamps = false;
   protected $primaryKey="idcategoria";
   protected $table="tbl_categoria";
   protected $fillable = [ 'categoria','imagencat'];
}
