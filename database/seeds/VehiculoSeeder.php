<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Fabricante;
use App\Vehiculo;
use Faker\Factory as Faker;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker=Faker::create();
        $cantidad=Fabricante::all()->count();
        for ($i=0; $i < $cantidad; $i++) { 
            Vehiculo::create
            ([
                'color'=>$faker->safeColorName(),
                'cilindraje'=>$faker->randomFloat(2,0,100000),
                'potencia'=>$faker->randomNumber(),
                'peso'=>$faker->randomFloat(2,0,100000),
                'fabricante_id'=>$faker->numberBetween(1,$cantidad)
            ]);
        }
    }
}
