@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-list me-2"></i>รายการบันทึกการใช้น้ำมัน</h4>
        </div>
        <div class="card-body table-responsive">
            @if($fuels->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>วันที่</th>
                            <th>เลขใบสั่งจ่าย</th>
                            <th>เลขใบเสร็จ</th>
                            <th>เลขทะเบียน</th>
                            <th>ระยะทาง (กม.)</th>
                            <th>น้ำมัน (ลิตร)</th>
                            <th>จำนวนเงิน (บาท)</th>
                            <th>ผู้สั่งจ่าย</th>
                            <th>ผู้รับ</th>
                            <th>หมายเหตุ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fuels as $fuel)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($fuel->date)->format('d/m/Y') }}</td>
                            <td>{{ $fuel->fuel_order_number }}</td>
                            <td>{{ $fuel->receipt_number }}</td>
                            <td>{{ $fuel->license_plate }}</td>
                            <td class="text-end">{{ number_format($fuel->distance) }}</td>
                            <td class="text-end">{{ number_format($fuel->fuel_liters, 2) }}</td>
                            <td class="text-end">{{ number_format($fuel->amount_spent) }}</td>
                            <td>{{ $fuel->issued_by }}</td>
                            <td>{{ $fuel->receiver }}</td>
                            <td>{{ $fuel->remark }}</td>
                            <td class="text-center">
                                <a href="{{ route('fuel.edit', $fuel->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('fuel.destroy', $fuel->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $fuels->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">
                    <i class="fas fa-info-circle me-1"></i> ไม่มีข้อมูลการใช้น้ำมัน
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
