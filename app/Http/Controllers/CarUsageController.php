<?php

namespace App\Http\Controllers;
use App\Models\CarUsage;
use App\Models\CarRequest;
use Illuminate\Http\Request;

class CarUsageController extends Controller
{
    public function create()
    {
        $approvedRequests = CarRequest::where('status', 'approved')->get();
        return view('car_usage.create', compact('approvedRequests'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'sequence' => 'nullable|integer',
        'date' => 'required|date',
        'time' => 'required',
        'user_name' => 'required|string',
        'destination' => 'required|string',
        'start_mileage' => 'required|numeric',
        'end_mileage' => 'required|numeric|gte:start_mileage',
        'driver_name' => 'required|string',
        'return_date' => 'required|date',
        'return_time' => 'required',
        'notes' => 'nullable|string',
    ]);

    $validated['total_distance'] = $validated['end_mileage'] - $validated['start_mileage'];

    CarUsage::create($validated);

    return redirect()->route('car-usage.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
}

public function index()
{
    $carUsages = CarUsage::orderBy('date', 'desc')->get();

    return view('car_usage.index', compact('carUsages'));
}





}

