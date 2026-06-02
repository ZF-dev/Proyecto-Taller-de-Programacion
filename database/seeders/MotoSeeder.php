<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motos;
use App\Models\Marcas;

class MotoSeeder extends Seeder
{
    public function run()
    {
        Motos::truncate();   // borra todas las motos

        // Leer archivo JSON
        $json = file_get_contents(config_path('productos.json'));
        $motos = json_decode($json, true);

        foreach ($motos as $dato) {
            // Crear o buscar la marca automáticamente
            $marca = Marcas::firstOrCreate(['nombre' => $dato['marca']]);

            // Insertar la moto
            Motos::create([
                'nombre'      => $dato['nombre'],
                'descripcion' => $dato['descripcion'],
                'precio'      => $dato['precio'],
                'imagen'      => $dato['imagen'] ?? null,
                'marca_id'    => $marca->id,
                'stock'       => $dato['stock'] ?? 10,   // usa default si no está
                'activo'      => $dato['activo'] ?? true // usa default si no está
            ]);
        }
    }
}
