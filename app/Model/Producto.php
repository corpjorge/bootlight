<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
      /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre', 'precio', 'referencia', 'descripcion', 'categoria_id',
  ];

  public function Categoria()
  {
      return $this->belongsTo('App\Model\Categorias','categoria_id');
  }

}
