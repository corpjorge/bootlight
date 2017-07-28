<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new User();
    	$table->name="Admin";
    	$table->email="admin@corpjorge.com";
    	$table->password= crypt("111111","");
    	$table->rol_id=1;
    	$table->save();
    }
}
