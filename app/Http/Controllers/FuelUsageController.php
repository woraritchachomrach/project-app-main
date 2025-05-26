<?php

namespace App\Http\Controllers;

use App\Models\FuelUsage;
use Illuminate\Http\Request;

class FuelUsageController extends Controller
{
    public function index()
    {
        $usages = FuelUsage::all();
        return view('fuel.index', compact('usages'));
    }

    public function create()
    {
        return view('fuel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'license_plate' => 'required',
            // เพิ่มการตรวจสอบอื่น ๆ ตามความเหมาะสม
        ]);

        FuelUsage::create($request->all());

        return redirect()->route('fuel.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
}
