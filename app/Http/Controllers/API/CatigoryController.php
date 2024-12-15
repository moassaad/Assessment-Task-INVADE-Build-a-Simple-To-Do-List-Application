<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catigory\CatigoryRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\CatigoryResource;
use App\Models\Catigory;
use App\Models\Task;
use App\Services\APIResponse;
use Auth;
use Illuminate\Http\Request;

class CatigoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $catigories = Catigory::where(['user_id'=>$user->user_id])
            ->orderBy('created_at','desc')->paginate(12);
        return APIResponse::new()->successOk('success', new PaginateResource($catigories, CatigoryResource::class));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatigoryRequest $request)
    {
        $valid = $request->validated();
        Catigory::create([
            'catigory_id'=>\Str::random(64),
            'catigory_name'=>$valid['catigory_name'],
            'color'=>$valid['color'],
            'user_id'=>Auth::user()->user_id
        ]);
        return APIResponse::new()->successCreated('success add new catigory!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catigory $catigory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catigory $catigory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatigoryRequest $request, Catigory $catigory)
    {
        $valid = $request->validated();
        // return response($valid);
        $catigory->catigory_name = $valid['catigory_name'];
        $catigory->color = $valid['color'];
        $catigory->update();
        return APIResponse::new()->successOk('success update catigory!', new CatigoryResource($catigory));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catigory $catigory)
    {
        Task::where(['catigory_id'=>$catigory->catigory_id])->delete();
        $check = $catigory->delete();
        if($check)
        {
            return APIResponse::new()->successOk('success deleted catigory.', new CatigoryResource($catigory));
        }
    }
}
