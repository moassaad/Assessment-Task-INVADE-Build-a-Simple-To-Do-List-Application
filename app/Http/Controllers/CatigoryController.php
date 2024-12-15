<?php

namespace App\Http\Controllers;

use App\Http\Requests\Catigory\CatigoryRequest;
use App\Models\Catigory;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;

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
        // return response($tasks);
        return view('catigory.index',compact(['catigories']));
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
        return back()->with('success','success add new catigory!');
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
        return back()->with('success','success update catigory!');
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
            return back()->with('success','success deleted catigory.');
        }
    }
}
