<?php

namespace App\Http\Controllers;

use App\Models\SettingModel; // Pastikan impor model Setting

class LandingController extends Controller
{
    public function index()
    {
        $settingItem = SettingModel::first(); // Gunakan model Setting
        return view('landing', compact('settingItem'));
    }
}
