<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moto;   
use App\Models\Marca;  
use Illuminate\Support\Facades\Schema;

class MotoSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Moto::truncate(); 
        Schema::enableForeignKeyConstraints();

        $json = file_get_contents(config_path('productos.json'));
        $motos = json_decode($json, true);

        if ($motos) {
            foreach ($motos as $dato) {
                $marca = Marca::firstOrCreate(['nombre' => $dato['marca']]);

                Moto::create([
                    'nombre'      => $dato['nombre'],
                    'descripcion' => $dato['descripcion'],
                    'precio'      => $dato['precio'],
                    'imagen'      => $dato['imagen'] ?? null,
                    'marca_id'    => $marca->id,
                    'stock'       => $dato['stock'] ?? 10,   
                    'activo'      => $dato['activo'] ?? true 
                ]);
            }
        }
    }
}


