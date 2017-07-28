<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
	  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre', 'descripcion',
  ];

  public function productos()
   {
       return $this->hasMany('App\Model\Producto');
   }
     
}
