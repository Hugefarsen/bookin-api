<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomPropertyResource;
use App\RoomProperty;
use Illuminate\Http\Request;

class RoomPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomProperty = RoomProperty::paginate(10);

        return RoomPropertyResource::collection($roomProperty);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roomProperty = $request->isMethod('put') ? RoomProperty::findOrFail
        ($request->room_property_id) : new RoomProperty;

        $roomProperty->id = $request->input('room_property_id');

        if($roomProperty->save()){
            return new RoomPropertyResource($roomProperty);
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
        $roomProperty = RoomPropertyResource::findOrFail($id);

        return new RoomPropertyResource($roomProperty);
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
        $roomProperty = RoomPropertyResource::findOrFail($id);

        if ($roomProperty->destroy()){
            return new RoomPropertyResource($roomProperty);
        }
    }
}
