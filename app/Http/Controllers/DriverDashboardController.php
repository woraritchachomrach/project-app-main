<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverDashboardController extends Controller
{
    public function driverDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'driver') {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        $requests = VehicleRequest::with(['user', 'vehicle'])
            ->where('status', 'approved')
            ->where('driver', $user->name)
            ->orderBy('start_time', 'asc')
            ->get();

            return view('driver.driverdashboard', compact('requests'));
    }
}
