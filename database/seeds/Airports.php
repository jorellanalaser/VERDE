<?php

use Illuminate\Database\Seeder;

class Airports extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airports')->insert([
            [ 'code' => 'CCS', 'name' => "Simón Bolivar", 'city' => "Caracas", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'PMV', 'name' => "Del Caribe Intl Gen Santiago Marino", 'city' => "Porlamar", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'VIG', 'name' => "Juan Pablo Pérez Alfonso Airport", 'city' => "El Vigía", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'MAR', 'name' => "La Chinita Intl", 'city' => "Maracaibo", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'BLA', 'name' => "General Jose Antonio Anzoategui Intl", 'city' => "Barcelona", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'VLN', 'name' => "Arturo Michelena Intl", 'city' => "Valencia", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'LFR', 'name' => "La Fria", 'city' => "La Fria", 'enabled' => 1, 'is_origin' => 1, 'int' => 0],
            [ 'code' => 'AUA', 'name' => "Reina Beatrix Intl", 'city' => "Oranjestad", 'enabled' => 1, 'is_origin' => 0, 'int' => 1],
            [ 'code' => 'SDQ', 'name' => "Las Americas Intl", 'city' => "Santo Domingo", 'enabled' => 1, 'is_origin' => 0, 'int' => 1],
            [ 'code' => 'PTY', 'name' => "Tocumen Intl", 'city' => "Panama City", 'enabled' => 1, 'is_origin' => 0, 'int' => 1],
            [ 'code' => 'PUJ', 'name' => "Punta Cana Intl", 'city' => "Punta Cana", 'enabled' => 1, 'is_origin' => 0, 'int' => 1],
            [ 'code' => 'CUR', 'name' => "Hato Intl Airport Coracao", 'city' => "Willemstad", 'enabled' => 1, 'is_origin' => 0, 'int' => 1]
        ]);
    }
}
