<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $items = [
       ['title' => '+5 Dexterity Vest', 'quality' => 20, 'sell_in' => 10],
       ['title' => 'Aged Brie', 'quality' => 0, 'sell_in' => 2],
       ['title' => 'Elixir of the Mongoose', 'quality' => 7, 'sell_in' => 5],
       ['title' => 'Sulfuras, Hand of Ragnaros', 'quality' => 80, 'sell_in' => 0],
       ['title' => 'Sulfuras, Hand of Ragnaros', 'quality' => 80, 'sell_in' => -1],
       ['title' => 'Backstage passes to a TAFKAL80ETC concert', 'quality' => 20, 'sell_in' => 15],
       ['title' => 'Backstage passes to a TAFKAL80ETC concert', 'quality' => 49, 'sell_in' => 10],
       ['title' => 'Backstage passes to a TAFKAL80ETC concert', 'quality' => 49, 'sell_in' => 5],
       ['title' => 'Conjured Mana Cake', 'quality' => 6, 'sell_in' => 3],
     ];

     foreach ($items as $item) {
         Item::create($item);
     }
    }
}
