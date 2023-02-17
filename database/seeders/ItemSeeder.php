<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $item = [
                'name' => 'Item ' . $i,
                'description' => 'Description ' . $i,
                'image' => 'image' . $i . '.jpg',
                'price' => $i * 10000,
                'stock' => $i * 10,
                'weight' => $i * 5,
            ];
            Item::create($item);
        }
    }
}
