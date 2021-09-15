<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class creacionProductosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=100;$i++)
        {

            DB::table('productos')->insert([
                'nombre'=>'producto'.$i,
                'descripcion'=>'producto de prueba'.$i,
                'precio'=> rand(0,100),
                'SKU'=>'producto'.rand(0, 100000),
                'inventario'=>rand(5, 100),
                'imagen'=>'no-image',
            ]);
        }
    }
}
