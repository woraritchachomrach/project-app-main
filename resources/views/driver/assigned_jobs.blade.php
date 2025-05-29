@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📋 งานที่ได้รับมอบหมาย</h2>

    @if ($requests->isEmpty())
        <div class="alert alert-info text-center">
            ยังไม่มีงานที่ได้รับมอบหมาย
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($requests as $request)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">🧾 งานที่ {{ $loop->iteration }} - สถานที่: {{ $request->destination }}</h5>
                            <ul class="list-unstyled mb-0">
                                <li><strong>🧑‍💼 ผู้ขอ:</strong> {{ $request->name }}</li>
                                <li><strong>📝 เรื่อง:</strong> {{ $request->purpose }}</li>
                                <li><strong>🕒 วันเวลาที่ประชุม:</strong> {{ \Carbon\Carbon::parse($request->meeting_datetime)->format('d/m/Y H:i') }}</li>
                                <li><strong>📍 จังหวัด:</strong> {{ $request->province }}</li>
                                <li><strong>🧑‍💼 จำนวนคนนั่ง:</strong> {{ $request->seats }}</li>
                                <li><strong>🚗 รถ:</strong> {{ $request->car_name }}</li>
                                <li><strong>🔢 ทะเบียน:</strong> {{ $request->car_registration ?? '-' }}</li>
                                <li><strong>👨‍✈️ คนขับ:</strong> {{ $request->driver }}</li>
                                <li><strong>📆 วันที่ไป/กลับ:</strong> {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y H:i') }} ถึง {{ \Carbon\Carbon::parse($request->end_time)->format('d/m/Y H:i') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
