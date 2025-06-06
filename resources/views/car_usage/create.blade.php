@extends('layouts.app')

    @section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold">
                    <i class="fas fa-car me-2"></i>แบบบันทึกการใช้รถราชการ
                </h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('car-usage.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="request_selector" class="form-label fw-semibold">
                            <i class="bi bi-check-circle me-1"></i>เลือกคำขอที่อนุมัติแล้ว
                        </label>
                        <select id="request_selector" class="form-select form-select-sm" required>
                            <option value="">-- เลือกคำขอ --</option>
                            @foreach($approvedRequests as $req)
                                <option value="{{ $req->id }}" data-request='@json($req)'>
                                    {{ $req->car_name }} - {{ $req->destination }} ({{ \Carbon\Carbon::parse($req->start_time)->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- แถวที่ 1 -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-2">
                            <label for="sequence" class="form-label fw-semibold text-muted">
                                <i class="fas fa-list-ol me-1"></i>ลำดับ
                            </label>
                            <input type="number" name="sequence" id="sequence"class="form-control form-control-sm" placeholder="ระบุลำดับ"value="{{ $latestSequence }}" readonly>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="date" class="form-label fw-semibold text-muted">
                                <i class="far fa-calendar-alt me-1"></i>วันที่ออกเดินทาง
                            </label>
                            <input type="date" name="date" id="date" class="form-control form-control-sm" required readonly>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="time" class="form-label fw-semibold text-muted">
                                <i class="far fa-clock me-1"></i>เวลา
                            </label>
                            <input type="time" name="time" id="time" class="form-control form-control-sm" required readonly>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="user_name" class="form-label fw-semibold text-muted">
                                <i class="fas fa-user me-1"></i>ผู้ใช้รถ
                            </label>
                            <input type="text" name="user_name" id="user_name" class="form-control form-control-sm"  placeholder="ชื่อผู้ใช้รถ" required readonly>
                        </div>
                    </div>

                    <!-- แถวที่ 2 -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label for="destination" class="form-label fw-semibold text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>สถานที่ไป
                            </label>
                            <input type="text" name="destination" id="destination" class="form-control form-control-sm" placeholder="ระบุจุดหมายปลายทาง" required readonly>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="start_mileage" class="form-label fw-semibold text-muted">
                                <i class="fas fa-tachometer-alt me-1"></i>เลขไมล์เมื่อออก
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="number" name="start_mileage" id="start_mileage" class="form-control" placeholder="เลขไมล์" required>
                                <span class="input-group-text">กม.</span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="driver_name" class="form-label fw-semibold text-muted">
                                <i class="fas fa-id-card me-1"></i>พนักงานขับรถ
                            </label>
                            <input type="text" name="driver_name" id="driver_name" class="form-control form-control-sm" placeholder="ชื่อพนักงานขับรถ" required readonly>
                        </div>
                    </div>

                    <!-- แถวที่ 3 -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="return_date" class="form-label fw-semibold text-muted">
                                <i class="far fa-calendar-check me-1"></i>วันที่กลับถึงสำนักงาน
                            </label>
                            <input type="date" name="return_date" id="return_date" class="form-control form-control-sm" required readonly>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="return_time" class="form-label fw-semibold text-muted">
                                <i class="far fa-clock me-1"></i>เวลากลับ
                            </label>
                            <input type="time" name="return_time" id="return_time" class="form-control form-control-sm" required readonly>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="end_mileage" class="form-label fw-semibold text-muted">
                                <i class="fas fa-tachometer-alt me-1"></i>เลขไมล์เมื่อกลับ
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="number" name="end_mileage" id="end_mileage" class="form-control" placeholder="เลขไมล์" required>
                                <span class="input-group-text">กม.</span>
                            </div>
                        </div>
                    </div>

                    <!-- แถวที่ 4 -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="total_distance" class="form-label fw-semibold text-muted">
                                <i class="fas fa-road me-1"></i>รวมระยะทาง
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="total_distance" id="total_distance" class="form-control bg-light" placeholder="คำนวณอัตโนมัติ" readonly>
                                <span class="input-group-text">กม.</span>
                            </div>
                        </div>
                    </div>

                    <!-- หมายเหตุ -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold text-muted">
                            <i class="fas fa-edit me-1"></i>หมายเหตุ
                        </label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="ระบุหมายเหตุเพิ่มเติม (ถ้ามี)"></textarea>
                    </div>

                    <!-- ปุ่มดำเนินการ -->
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-secondary px-4" >
                            <i class="fas fa-undo me-1"></i>ล้างข้อมูล
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>บันทึกข้อมูล
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @push('styles')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selector = document.getElementById('request_selector');

        selector.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const data = selectedOption.getAttribute('data-request');

            if (data) {
                const request = JSON.parse(data);

                document.getElementById('date').value = request.start_time.slice(0, 10);
                document.getElementById('time').value = request.start_time.slice(11, 16);
                document.getElementById('user_name').value = request.user_name || '';
                document.getElementById('destination').value = request.destination;
                document.getElementById('driver_name').value = request.driver;
                document.getElementById('return_date').value = request.end_time.slice(0, 10);
                document.getElementById('return_time').value = request.end_time.slice(11, 16);
                document.getElementById('notes').value = เดินทางไป ${request.purpose} จำนวน ${request.seats} คน;
            }
        });

        const startMileage = document.getElementById('start_mileage');
        const endMileage = document.getElementById('end_mileage');
        const totalDistance = document.getElementById('total_distance');

        function updateTotalDistance() {
            const start = parseFloat(startMileage.value);
            const end = parseFloat(endMileage.value);
            if (!isNaN(start) && !isNaN(end) && end >= start) {
                totalDistance.value = (end - start).toFixed(1);
            } else {
                totalDistance.value = '';
            }
        }

        startMileage.addEventListener('input', updateTotalDistance);
        endMileage.addEventListener('input', updateTotalDistance);

        // ====== NEW CODE HERE ======
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            const selectedIndex = selector.selectedIndex;
            if (selectedIndex > 0) {
                selector.removeChild(selector.options[selectedIndex]);
            }
        });
    });
    </script>
    @endpush