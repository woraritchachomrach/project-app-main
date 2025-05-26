@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-gas-pump me-2"></i>บันทึกการใช้น้ำมัน</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('fuel.store') }}" method="POST">
                @csrf

                {{-- วันที่ + เลขใบสั่งจ่าย / ใบเสร็จ + เลขทะเบียน --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">วันที่:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">เลขใบสั่งจ่าย / ใบเสร็จรับเงิน:</label>
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="input-group">
                                    <input type="text" name="fuel_order_number[]" class="form-control">
                                    <span class="input-group-text">เล่มที่</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="receipt_number[]" class="form-control">
                                    <span class="input-group-text">เลขที่</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">เลขทะเบียน:</label>
                        <input type="text" name="license_plate" class="form-control">
                    </div>
                </div>

                {{-- ระยะทาง / น้ำมัน / จำนวนเงิน + ผู้สั่งจ่าย + ผู้รับ --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">เลขระยะทางเมื่อขอเติม:</label>
                        <input type="number" name="start_km" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ระยะทาง:</label>
                        <div class="input-group">
                            <input type="number" name="distance" class="form-control">
                            <span class="input-group-text">กม.</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">น้ำมันเชื้อเพลิง:</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="fuel_liters" class="form-control">
                            <span class="input-group-text">ลิตร</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">จำนวนเงิน:</label>
                        <div class="input-group">
                            <input type="number" name="amount_spent" class="form-control">
                            <span class="input-group-text">บาท</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ผู้สั่งจ่าย:</label>
                        <input type="text" name="issued_by" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ผู้รับ:</label>
                        <input type="text" name="receiver" class="form-control">
                    </div>
                </div>

                {{-- หมายเหตุ --}}
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">หมายเหตุ:</label>
                        <textarea name="remark" rows="10" class="form-control"></textarea>
                    </div>
                </div>

                {{-- ปุ่มบันทึก --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> บันทึกข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
