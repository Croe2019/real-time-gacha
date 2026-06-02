<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GachaItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Common Ticket', 'rarity' => 1, 'weight' => 80],
            ['name' => 'Rare Sword', 'rarity' => 5, 'weight' => 20],
            ['name' => 'Epic Shield', 'rarity' => 10, 'weight' => 5],
            ['name' => 'Legendary Staff', 'rarity' => 20, 'weight' => 1],
        ];

        DB::table('gacha_items')->insert($items);
    }
}
