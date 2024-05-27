<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sensor::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sensor = new Sensor;
        $sensor->name = $request->name;
        $sensor->nilai = $request->nilai;
        $sensor->save();
        return response()->json([
            "message" => "Sensor Telah Ditambahkan."
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Sensor::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Sensor::where('id', $id)->exists()) {
            $sensor = Sensor::find($id);
            $sensor->name = is_null($request->name) ? $sensor->name:$request->name;
            $sensor->nilai = is_null($request->nilai) ? $sensor->nilai:$request->nilai;
            $sensor->save();
            return response()->json([
                "message" => "Sensor telah diupdate."
            ], 201);
        }else {
            return response()->json([
                "message" => "Sensor tidak ditemukan."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Sensor::where('id', $id)->exists()) {
            $sensor = Sensor::find($id);
            $sensor->delete();
            return response()->json([
            "message"=> "Sensor telah dihapus."
            ], 201);
            } else {
            return response() >json([
            "message"=> "Sensor tidak ditemukan."
            ], 404);
            }
        }
}
