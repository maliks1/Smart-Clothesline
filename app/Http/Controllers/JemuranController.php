<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Exception;

class JemuranController extends Controller
{
    public function buka()
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->publish('jemuran/servo/command', '0'); // buka
            return back()->with('status', 'Jemuran dibentangkan');
        } catch (Exception $e) {
            return back()->withErrors(['mqtt' => 'Gagal mengirim perintah ke server MQTT: ' . $e->getMessage()]);
        }
    }

    public function tutup()
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->publish('jemuran/servo/command', '1'); // tutup
            return back()->with('status', 'Jemuran ditutup');
        } catch (Exception $e) {
            return back()->withErrors(['mqtt' => 'Gagal mengirim perintah ke server MQTT: ' . $e->getMessage()]);
        }
    }
}