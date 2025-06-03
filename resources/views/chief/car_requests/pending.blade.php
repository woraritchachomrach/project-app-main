@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm mx-auto w-100">
        <div class="card-body">
            <h3 class="mb-4 text-primary text-center">📝 รายการคำขอใช้รถ (รออนุมัติ)</h3>

            {{-- แสดงข้อความแจ้งเตือน --}}
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @elseif(session('danger'))
                <div class="alert alert-danger text-center">{{ session('danger') }}</div>
            @endif

            {{-- กรณีไม่มีคำขอ --}}
            @if ($requests->isEmpty())
                <div class="alert alert-warning text-center">ยังไม่มีคำขอที่รออนุมัติ</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>รูป</th>
                                <th>พนักงานขับรถ</th>
                                <th>เบอร์คนขับ</th>
                                <th>จำนวนคนนั่ง</th>
                                <th>ทะเบียนรถ</th>
                                <th>รถ</th>
                                <th>ผู้ขอ</th>
                                <th>เบอร์ผู้ขอ</th>
                                <th>ตำแหน่ง</th>
                                <th>กลุ่ม</th>
                                <th>สถานที่</th>
                                <th>จังหวัด</th>
                                <th>เพื่อ (ไปทำอะไร)</th>
                                <th>เวลาที่ประชุม</th>
                                <th>เวลาไป / กลับ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $req->car_image) }}"
                                             class="rounded shadow-sm"
                                             style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $req->driver }}</td>
                                    <td>{{ $req->driver_phone }}</td>
                                    <td>{{ $req->seats }}</td>
                                    <td>{{ $req->car_registration }}</td>
                                    <td>{{ $req->car_name }}</td>
                                    <td>{{ $req->name }}</td>
                                    <td>{{ $req->requester_phone }}</td>
                                    <td>{{ $req->position }}</td>
                                    <td>{{ $req->department }}</td>
                                    <td>{{ $req->destination }}</td>
                                    <td>{{ $req->province }}</td>
                                    <td>{{ $req->purpose }}</td>
                                    <td>{{ \Carbon\Carbon::parse($req->meeting_datetime)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($req->start_time)->format('d/m/Y H:i') }}<br>
                                        <strong>ถึง</strong><br>
                                        {{ \Carbon\Carbon::parse($req->end_time)->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('chief.car-requests.approve', $req->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm mb-1"
                                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าจะอนุมัติคำขอนี้?')">
                                                ✅ อนุมัติ
                                            </button>
                                        </form>
                                        <form action="{{ route('chief.car-requests.reject', $req->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('คุณแน่ใจหรือไม่ว่าจะไม่อนุมัติคำขอนี้?')">
                                                ❌ ไม่อนุมัติ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
