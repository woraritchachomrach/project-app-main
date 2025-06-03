@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-warning">🕒 รายการคำขอรถส่วนตัว (รออนุมัติ)</h2>

    @if($requests->isEmpty())
        <div class="alert alert-info">ยังไม่มีคำขอ</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>ชื่อ</th>
                    <th>เบอร์โทร</th>
                    <th>ตำแหน่ง</th>
                    <th>แผนก</th>
                    <th>ยี่ห้อรถ</th>
                    <th>ทะเบียน</th>
                    <th>จำนวนที่นั่ง</th>
                    <th>สถานที่ไป</th>
                    <th>จังหวัด</th>
                    <th>วัตถุประสงค์</th>
                    <th>เวลาออกเดินทาง</th>
                    <th>เวลากลับ</th>
                    <th>เหตุผลเพิ่มเติม</th>
                    <th>ไฟล์แนบ</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                <tr>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->phone }}</td>
                    <td>{{ $req->position }}</td>
                    <td>{{ $req->department }}</td>
                    <td>{{ $req->car_brand }}</td>
                    <td>{{ $req->car_registration }}</td>
                    <td>{{ $req->seats }}</td>
                    <td>{{ $req->destination }}</td>
                    <td>{{ $req->province }}</td>
                    <td>{{ $req->purpose }}</td>
                    <td>{{ \Carbon\Carbon::parse($req->start_time)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($req->end_time)->format('d/m/Y H:i') }}</td>
                    <td>{{ $req->reason ?? '-' }}</td>
                    <td>
                        @if ($req->attachment)
                            <a href="{{ asset('storage/' . $req->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary">📎</a>
                        @else
                            -
                        @endif
                    </td>
                    <td><span class="badge bg-warning text-dark">รออนุมัติ</span></td>
                    <td>
                        <form method="POST" action="{{ route('chief.personal-requests.approve', $req->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">✅</button>
                        </form>
                        <form method="POST" action="{{ route('chief.personal-requests.reject', $req->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">❌</button>
                        </form>
                        <a href="{{ route('personal-car-requests.show', $req->id) }}" class="btn btn-info btn-sm">🔍</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
