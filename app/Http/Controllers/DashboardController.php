<?php

namespace App\Http\Controllers;

use App\Dosenlb;
use Illuminate\Http\Request;
use App\Perangkat;
use App\Semester;
use App\User;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];
    $query = Perangkat::all();
    $count_user = User::count();
    $count_dosenlb = Dosenlb::count();
    $getSemester = Semester::where('a_periode_aktif','1')->first();
    return view('/content/dashboard/dashboard-ecommerce', [
      'pageConfigs' => $pageConfigs,
      'perangkat'=> $query,
      'count_user'=> $count_user,
      'count_dosenlb' => $count_dosenlb,
      'getSemester' => $getSemester ]);
  }
}
