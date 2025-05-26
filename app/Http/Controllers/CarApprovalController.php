<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarRequest;
use App\Notifications\CarRequestReviewed;

class CarApprovalController extends Controller
{
    public function pending()
    {
        $requests = CarRequest::where('status', 'pending')->get(); //กรองแบบเฉพาะที่ chief ดูแล
        return view('chief.car_requests.pending', compact('requests'));
    }

    public function Chiefapprove($id)
    {
        $req = CarRequest::findOrFail($id);
        $req->status = 'approved';
        $req->save();

        $req->user->notify(new CarRequestReviewed($req)); // แจ้งเตือนเจ้าของคำขอ

        return back()->with('success', 'อนุมัติคำขอเรียบร้อยแล้ว');
    }

    public function Chiefreject($id)
    {
        $req = CarRequest::findOrFail($id);
        $req->status = 'rejected';
        $req->save();

        $req->user->notify(new CarRequestReviewed($req)); // แจ้งเตือนเจ้าของคำขอ

        return back()->with('success', 'ไม่อนุมัติคำขอ');
    }
}
