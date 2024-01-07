<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $phones = Phone::all();
        return response()->json(["phones"=>$phones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $phone = new Phone();
        $phone->name= $request->name;
        $phone->brand= $request->brand;
        $phone->model= $request->model;
        $phone->description= $request->description;
        $phone->year= $request->year;
        $phone->save();
        return response()->json([
            "message" => "Phone added successfully",
            "phone" => $phone
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $phone= Phone::find($id);
        return response()->json(["phone"=>$phone], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // $phone= Phone::find($id)->first();
        // return response()->json([
        //     "message" => "Phone Updated successfully",
        //     "phone" => $phone
        // ],201);
        // die();
        // $phone = Phone::where('id',$id)->first();
        $phone= Phone::find($id);
        $phone->name= $request->name;
        $phone->brand= $request->brand;
        $phone->model= $request->model;
        $phone->description= $request->description;
        $phone->year= $request->year;
        $phone->save();
        return response()->json([
            "message" => "Phone Updated successfully",
            "phone" => $phone
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $phone = Phone::where('id',$id)->first();
        $phone->delete();
        return response()->json([
            "message" => "Phone deleted successfully",
        ],201);

    }
}
