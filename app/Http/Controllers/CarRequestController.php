<?php

namespace App\Http\Controllers;

use App\Models\CarRequest;
use App\Notifications\CarRequestReviewed;
use App\Notifications\CarRequestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class CarRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //public function approve(CarRequest $carRequest)
    //{
    //    $carRequest->update(['status'=>'approve']);
    //    return back()->with('success','อนุมัติเรียบร้อย');
    //}

    //public function reject(CarRequest $carRequest)
    //{
    //    $carRequest->update(['status'=>'rejected']);
    //    return back()->with('error','ไม่อนุมัติ');
    //}


    public function index()
    {
        $requests = CarRequest::where('user_id', auth::id())->latest()->get();
        return view('car_requests.list', compact('requests'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultDate = session('car_request_date', null);
        return view('car_requests.form', compact('defaultDate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_image' => 'required|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'department' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'destination' => 'required|string',
            'seats' => 'required|numeric|min:1|max:99',
            'car_registration' => 'required|string',
            'driver' => 'required|string',
            'reason' => 'nullable|string',
        ]);
        $validated['user_id'] = Auth::id();

        // สร้างคำขอใหม่และเก็บผลลัพธ์ในตัวแปร $carRequest
        $carRequest = CarRequest::create($validated);

        $chief = User::where('role', 'chief')->first();
        $chief->notify(new CarRequestSubmitted($carRequest));
        $carRequest->user->notify(new CarRequestReviewed($carRequest));

        return redirect()->route('car-requests.create')->with('success', 'ส่งคำขอเรียบร้อย');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = CarRequest::where('id', $id)
            ->where('user_id', auth::id()) // ป้องกันดูของคนอื่น
            ->firstOrFail();

        return view('car_requests.show', compact('request'));
    }

    // แสดงข้อมูลทั้งหมดในปฏิทิน
    public function calendarEvents()
    {
        $requests = CarRequest::where('user_id', auth::id())->get();

        $events = [];

        foreach ($requests as $request) {
            $events[] = [
                'title' => $request->destination,
                'start' => $request->start_time,
                'end' => $request->end_time,
                'requester' => $request->name,
                'department' => $request->department,
                'car_registration' => $request->car_registration,
                'driver' => $request->driver,
                'start_time' => date('d/m/Y H:i', strtotime($request->start_time)),
                'end_time' => date('d/m/Y H:i', strtotime($request->end_time)),

            ];
        }

        return response()->json($events);
    }

    public function printFome($id)
    {
        $request = CarRequest::findOrFail($id);

        // สร้าง PDF และส่งไปที่ browser
        $pdf = Pdf::loadView('requests.print', compact('request'));

        return $pdf->stream('car_request_print');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

public function printForm($id)
{
    $request = CarRequest::findOrFail($id);
    
    $pdf = Pdf::loadView('car_requests.print', compact('request'));
    
    $pdf->setOption([
        'defaultFont' => 'THSarabunNew',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'fontDir' => public_path('fonts/'),
        'fontCache' => storage_path('fonts/'),
        'chroot' => realpath(base_path()),
        'isPhpEnabled' => true,
        'isFontSubsettingEnabled' => true,
    ]);
    
    return $pdf->stream('document.pdf');
}



}