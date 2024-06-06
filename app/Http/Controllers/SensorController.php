<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DHT11;
use App\Models\MQ5;
use App\Models\Rain;

class SensorController extends Controller
{
    public function web_dht11()
    {
        $data['title'] = 'Sensor';
        $data['breadcrumbs'] = [
            [
                'title' => 'Dashboard',
                'url' => route('dashboard')
            ],
            [
                'title' => 'Sensor',
                'url' => route('sensor.dht11')
            ]
        ];

        return view('pages.sensor', array_merge($data, [
            "dht11" => DHT11::all(),
            "mq5" => MQ5::all(),
            "rain" => Rain::all()
        ]));
    }

    public function api_dht11(Request $request)
    {
        $dht11 = new DHT11;
        $dht11->name = $request->name;
        $dht11->suhu = $request->suhu;
        $dht11->kelembapan = $request->kelembapan;
        $dht11->save();
        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function api_mq5(Request $request)
    {
        $mq5 = new MQ5;
        $mq5->name = $request->name;
        $mq5->nilai_gas = $request->nilai_gas;
        $mq5->save();
        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function api_rain(Request $request)
    {
        $rain = new Rain;
        $rain->name = $request->name;
        $rain->nilai_rain = $request->nilai_rain;
        $rain->save();
        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function get_dht11()
    {
        $dht11Data = DHT11::all();
        return response()->json($dht11Data);
    }

    public function get_mq5()
    {
        $mq5Data = MQ5::all();
        return response()->json($mq5Data);
    }

    public function get_rain()
    {
        $rainData = Rain::all();
        return response()->json($rainData);
    }
}
