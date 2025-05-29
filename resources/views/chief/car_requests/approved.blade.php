@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mx-auto w-100">
            <div class="card-body">
                <h3 class="mb-4 text-success text-center">✅ รายการคำขอที่อนุมัติแล้ว</h3>

                @if ($requests->isEmpty())
                    <div class="alert alert-info text-center">ยังไม่มีคำขอที่ได้รับการอนุมัติ</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>รูป</th>
                                    <th>พนักงานขับรถ</th>
                                    <th>จำนวนคนนั่ง</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>รถ</th>
                                    <th>ผู้ขอ</th>
                                    <th>ตำแหน่ง</th>
                                    <th>กลุ่ม</th>
                                    <th>สถานที่</th>
                                    <th>จังหวัด</th>
                                    <th>เพื่อ(ไปทำอะไร)</th>
                                    <th>เวลาที่ประชุม</th>
                                    <th>เวลาไป/กลับ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $req)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/images/' . $req->car_image) }}"
                                                class="rounded shadow-sm" style="width: 100px; height: auto;">
                                        </td>
                                        <td>{{ $req->driver }}</td>
                                        <td>{{ $req->seats }} คน</td>
                                        <td>{{ $req->car_registration }}</td>
                                        <td>{{ $req->car_name }}</td>
                                        <td>{{ $req->name }}</td>
                                        <td>{{ $req->position }}</td>
                                        <td>{{ $req->department }}</td>
                                        <td>{{ $req->destination }}</td>
                                        <td>{{ $req->province }}</td>
                                        <td>{{ $req->purpose }}</td>
                                        <td>{{ \Carbon\Carbon::parse($req->meeting_datetime)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($req->start_time)->format('d/m/Y H:i') }} <br>
                                            <strong>ถึง</strong><br>
                                            {{ \Carbon\Carbon::parse($req->end_time)->format('d/m/Y H:i') }}
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
