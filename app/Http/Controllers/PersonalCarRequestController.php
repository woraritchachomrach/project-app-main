<?php

namespace App\Http\Controllers;

use App\Models\PersonalCarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PersonalCarRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'car_brand' => 'required|string|max:255',
            'car_registration' => 'required|string|max:255',
            'seats' => 'required|numeric|max:99',
            'destination' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $attachmentPath = $request->hasFile('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : null;

        PersonalCarRequest::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'position' => $request->position,
            'department' => $request->department,
            'car_brand' => $request->car_brand,
            'car_registration' => $request->car_registration,
            'seats' => $request->seats,
            'destination' => $request->destination,
            'province' => $request->province,
            'purpose' => $request->purpose,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
            'status' => 'pending',
        ]);

        return redirect()->route('personal-car-requests.index')->with('success', 'ส่งคำขอเรียบร้อยแล้ว');
    }


    public function index()
    {
        $requests = PersonalCarRequest::latest()->get(); // ดึงข้อมูลทั้งหมด หรือใช้ paginate() ก็ได้
        return view('personal_car_requests.index', compact('requests'));
    }


    public function create()
    {
        return view('car_requests.personalcar');
    }

    public function show($id)
    {
        $request = PersonalCarRequest::findOrFail($id);
        return view('car_requests.detail', compact('request')); // เปลี่ยนตามชื่อใหม่ที่คุณตั้ง

    }
}
