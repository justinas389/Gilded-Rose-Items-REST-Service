<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Item;
use App\Http\Resources\Item as ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get items
        $items = Item::paginate(5);

        // Return collection of articles as resource
        return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = $request->isMethod('put') ? Item::findOrFail
        ($request->item_id) : new Item;

        $item->id = $request->input('item_id');
        $item->title = $request->input('title');
        $item->quality = $request->input('quality');
        $item->sell_in = $request->input('sell_in');

        if($item->save()) {
          return new ItemResource($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get item
        $item = Item::findOrFail($id);

        // Return single article as a resourcebundle_count
        return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Get item
      $item = Item::findOrFail($id);

      if($item->delete()) {
        return new ItemResource($item);
      }
    }
}
