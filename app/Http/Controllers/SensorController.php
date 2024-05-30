<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DHT11;
use App\Models\MQ5;
use App\Models\Rain;

class SensorController extends Controller
{
    public function api_dht11(Request $request)
    {
        $data ['title'] = 'Sensor';
        $data ['breadcrumbs'][]= [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data ['breadcrumbs'][]= [
            'title' => 'Sensor',
            'url' => 'sensor.api_dht11'
        ];

        // $dht11 = new DHT11;
        // $dht11 -> name = $request-> name;
        // $dht11 -> suhu = $request-> suhu;
        // $dht11 -> kelembapan = $request->kelembapan;
        // // $dht11 -> save();
        // return response () -> json ([
        //     "message" => "Data telah ditambahkan."
        // ], 201);

        return view('pages.sensor', $data);
    }

    public function api_mq5(Request $request)
    {
        $mq5 = new MQ5;
        $mq5 -> nilai_gas = $request->nilai_gas;
        $mq5 -> save();
        return response () -> json ([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function api_rain(Request $request)
    {
        $rain = new Rain;
        $rain -> nilai_rain = $request->nilai_rain;
        $rain -> save();
        return response () -> json ([
            "message" => "Data telah ditambahkan."
        ], 201);
    }


}
