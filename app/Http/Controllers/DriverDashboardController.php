<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarRequest;

class DriverDashboardController extends Controller
{
    public function driverDashboard()
    {
        return view('driver.driverdashboard');
    }

    public function assignedJobs()
    {
        $driverName = Auth::user()->name;

        $requests = CarRequest::where('driver', $driverName)
            ->where('status', 'approved')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('driver.assigned_jobs', compact('requests'));
    }
}
