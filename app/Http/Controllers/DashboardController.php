<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function userDashboard()
    {
        return view('car_requests.calendar');  // เปลี่ยนไปตามที่คุณต้องการให้แสดง
    }

    public function chiefDashboard()
    {
        if (Auth::user()->role !== 'chief') {
            abort(403);  // ป้องกัน role อื่นเข้า
        }

        return view('chief.dashboard');  // ✅ ไม่ redirect ซ้ำ
    }


    public function adminDashboard()
    {
        return view('admin.dashboard');  // เปลี่ยนไปตามที่คุณต้องการให้แสดง
    }
}
