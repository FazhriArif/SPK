<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use App\Models\ProdukModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\HasilModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $settingItem = SettingModel::first();
        $productCount = ProdukModel::count();
        $alternativeCount = AlternatifModel::count();
        $criteriaCount = KriteriaModel::count();
        $reportCount = HasilModel::count();
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'settingItem' => $settingItem,
            'productCount' => $productCount,
            'alternativeCount' => $alternativeCount,
            'criteriaCount' => $criteriaCount,
            'reportCount' => $reportCount, 
        ]);
    }

}
