<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class ChiefDriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('chief.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('chief.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|confirmed',
            'status' => 'required',
        ]);

        Driver::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => bcrypt($request->password), // ใช้ bcrypt หากเก็บ password
        ]);

        return redirect()->route('chief.drivers.index')->with('success', 'เพิ่มคนขับรถเรียบร้อยแล้ว');
    }

    public function edit(Driver $driver)
    {
        return view('chief.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'status' => 'required',
        ]);

        $driver->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('chief.drivers.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('chief.drivers.index')->with('success', 'ลบข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    
}
