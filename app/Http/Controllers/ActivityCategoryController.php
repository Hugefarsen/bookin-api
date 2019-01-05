<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityCategory;
use App\Http\Resources\ActivityCategoryResource;

class ActivityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityCategories = ActivityCategory::All();

        return ActivityCategoryResource::collection($activityCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activityCategory = $request->isMethod('put') ? ActivityCategory::findOrFail
        ($request->input('activity_category_id')) : new ActivityCategory;

        $activityCategory->id = $request->input('activity_category_id');
        $activityCategory->description = $request->input('description');
        $activityCategory->name = $request->input('name');

        if ($activityCategory->save()){
            return new ActivityCategoryResource($activityCategory);
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
        $activityCategory = ActivityCategory::findOrFail($id);

        return new ActivityCategoryResource($activityCategory);
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
        $activityCategory = ActivityCategory::findOrFail($id);

        if ($activityCategory->delete()){
            return new ActivityCategoryResource($activityCategory);
        }
    }
}
