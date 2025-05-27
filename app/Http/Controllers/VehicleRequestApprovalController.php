<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VehicleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VehicleRequestApprovalController extends Controller
{
    public function approve($id)
    {
        $request = VehicleRequest::findOrFail($id);

        //ตรวจสอบสิทธิ์หัวหน้า
        if (auth::user()->role !== 'chief') {
            abort(403);
        }

        //ดึงคนขับทั้งหมดเรียงตาม id
        $drivers = User::where('role', 'driver')->orderBy('id')->get();

        if ($drivers->isEmpty()) {
            return back()->with('error','ไม่พบคนขับรถ');
        }

        //ดึง driver assignment tracker
        $tracker = DB::table('driver_assignment_tracker')->first();
        $lastId = $tracker->last_driver_id ?? 0;
        
        //หา driver ถัดไป (วนรอบ)
        $nextDriver = $drivers->first(function ($driver) use ($lastId) {
            return $driver->id > $lastId;
        }) ?? $drivers->first();

        //อัปเดตคำขอและ tracker
        $request->update([
            'status' => 'approved',
            'driver' => $nextDriver->id,
        ]);

        DB::table('driver_assignment_tracker')->update([
            'last_driver_id' => $nextDriver->id,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'อนุมัติแล้วและมอบหมายคนขับแบบวนรอบ');
    }
}
