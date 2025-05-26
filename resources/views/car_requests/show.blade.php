@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center text-primary">รายละเอียดคำขอใช้รถ</h3>

        <div class="card shadow-sm border-0 rounded-lg">
            <div class="row g-0">
                <!-- รูปภาพ -->
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-light rounded-start">
                    @if ($request->car_image)
                        <img src="{{ asset('storage/images/' . $request->car_image) }}" alt="Car Image"
                            class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                    @else
                        <span class="text-muted">ไม่มีรูปภาพ</span>
                    @endif
                </div>

                <!-- ข้อมูลคำขอ -->
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ชื่อ:</strong> {{ $request->name }}</p>
                                <p><strong>ตำแหน่ง:</strong> {{ $request->position }}</p>
                                <p><strong>กลุ่ม:</strong> {{ $request->department }}</p>
                                <p><strong>จำนวนคนนั่ง:</strong> {{ $request->seats }}คน</p>
                                <p><strong>พนักงานขับรถ:</strong> {{ $request->driver ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>ช่วงเวลา:</strong></p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-calendar-event"></i> เริ่ม:
                                        {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y H:i') }}</li>
                                    <li><i class="bi bi-calendar-check"></i> สิ้นสุด:
                                        {{ \Carbon\Carbon::parse($request->end_time)->format('d/m/Y H:i') }}</li>
                                </ul>
                                <p><strong>สถานที่:</strong> {{ $request->destination }}</p>
                                <p><strong>ทะเบียนรถ:</strong> {{ $request->car_registration }}</p>
                                <p><strong>สถานะ:</strong>
                                    @if ($request->status == 'pending')
                                        <span class="badge bg-warning">รออนุมัติ</span>
                                    @elseif ($request->status == 'approved')
                                        <span class="badge bg-success">อนุมัติแล้ว</span>
                                    @else
                                        <span class="badge bg-danger">ไม่อนุมัติ</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <p><strong>เหตุผล:</strong></p>
                            <p class="bg-light p-2 rounded">{{ $request->reason ?? '-' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('car_request.print', $request->id) }}" target="_blank"
                        class="btn btn-outline-primary mt-3">
                        <i class="bi bi-printer"></i> พิมพ์ฟอร์มคำขอ
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
