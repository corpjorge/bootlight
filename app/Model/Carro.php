<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'usuario_temporal', 'producto_id', 
	];

	public function producto()
	{
		return $this->belongsTo('App\Model\Producto','producto_id');
	}
}
