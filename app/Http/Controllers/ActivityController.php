<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Activity;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::paginate(10);

        return ActivityResource::collection($activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = $request->isMethod('put') ? Activity::findOrFail
        ($request->activity_id) : new Activity;

        $start = $request->input('start');
        $end = $request->input('end');
        $room_id = $request->input('room_id');

        $preBooked = DB::table('activities')
            ->where('room_id', $room_id)
            ->whereBetween('start', [$request->input('start'), $request->input('end')])
            ->orWhere(function ($query) use ($start, $room_id) {
                $query->where('room_id', $room_id);
                $query->where('start', '<=', $start);
                $query->where('end', '>=', $start);
            })
            ->orWhere(function ($query) use ($end, $room_id) {
                $query->where('room_id', $room_id);
                $query->where('end', '<=', $end);
                $query->where('start', '>=', $end);
            })
            ->get();


        if (count($preBooked) > 0) {
            return response()->json(['prebooked'=>$preBooked], 409);
        }

        $activity->id = $request->input('activity_id');
        $activity->start = $start;
        $activity->end = $end;
        $activity->room_id = $request->input('room_id');
        $activity->category_id = $request->input('category_id');

        if ($activity->save()){
            $owner = User::find($request->input('owner'));
            $activity->owner()->attach($owner);
        }

        return new ActivityResource($activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return new ActivityResource($activity);
    }

    /**
     * Book the specified activity in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        $userId = $request->input('user_id');
        $activity = Activity::findOrFail($request->input('activity_id'));
        $activity->users()->attach($userId);

        return response()->json(new ActivityResource($activity), 200);
    }

    /**
     * Unbook the specified activity in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $userId = $request->input('user_id');
        $activity = Activity::findOrFail($request->input('activity_id'));
        $activity->users()->detach($userId);

        return response()->json(new ActivityResource($activity), 200);
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
        $activity = Activity::findOrFail($id);

        if($activity->delete()){
            return new ActivityResource($activity);
        }
    }
}
