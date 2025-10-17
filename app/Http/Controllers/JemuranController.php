<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class JemuranController extends Controller
{
    public function buka()
    {
        $mqtt = MQTT::connection();
        $mqtt->publish('jemuran/servo/command', '0'); // buka
        return back()->with('status', 'Jemuran dibentangkan');
    }

    public function tutup()
    {
        $mqtt = MQTT::connection();
        $mqtt->publish('jemuran/servo/command', '1'); // tutup
        return back()->with('status', 'Jemuran ditutup');
    }
}
