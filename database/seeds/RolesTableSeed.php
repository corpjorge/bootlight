<?php

use Illuminate\Database\Seeder;
use App\Model\Roles;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$table = new Roles();
    	$table->tipo="INICIO";
    	$table->descripcion="Administrador";
    	$table->save();
    }
}
