<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Item;

class ItemTest extends TestCase
{

    private $test_item = ['title' => 'Inser item title', 'quality' => '5', 'sell_in' => '10'];

    public function testGetItemsStatus()
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
    }

    public function testGetItem()
    {

        $item = new Item;
        $item->title = $this->test_item['title'];
        $item->quality = 6;
        $item->sell_in = 3;
        $item->save();
        $response = $this->get('/api/item/'.$item->id);

        $response->assertJsonFragment(["id" => $item->id]);

        $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('DELETE', '/api/item/'.$item->id, []);
    }

    public function testInsertItem()
    {
      $response = $this->withHeaders(['Content-Type' => 'application/json',])
                  ->json('POST', '/api/item/', $this->test_item);
      $content = json_decode($response->content());

      $response->assertJson(['id' => $content->id]);

      $this->withHeaders([
          'Content-Type' => 'application/json',
      ])->json('DELETE', '/api/item/'.$content->id, []);
    }

    public function testDeleteItem()
    {
      $response = $this->withHeaders(['Content-Type' => 'application/json'])
                  ->json( 'POST', '/api/item/',  $this->test_item);
      $content = json_decode($response->content());

      $this->withHeaders(['Content-Type' => 'application/json',])
      ->json('DELETE', '/api/item/'.$content->id);

      $this->assertEquals(null, Item::find($content->id));

    }
}
