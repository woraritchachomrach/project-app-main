@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-car-alt me-2"></i>แบบฟอร์มขอใช้รถราชการ
                    </h4>
                    <div class="badge bg-white text-primary fs-6 shadow-sm">
                        <i class="fas fa-file-alt me-1"></i>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('car-requests.store') }}" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <!-- ส่วนเลือกรถ -->
                    <div class="mb-5">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fas fa-car me-2"></i>เลือกรถที่ต้องการใช้
                        </h5>
                        <div class="row g-4">
                            @foreach (['7500_Moto3.jpg', 'images1.jpg', 'images2.jpg', 'images4.jpg'] as $car)
                                <div class="col-md-3 col-6">
                                    <div class="card h-100 border-0 shadow-sm car-option">
                                        <div class="card-img-top overflow-hidden" style="height: 150px;">
                                            <img src="{{ asset('storage/images/' . $car) }}"
                                                class="img-fluid w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="card-body text-center py-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="car_image"
                                                    id="car-{{ $loop->index }}" value="{{ $car }}" required>
                                                <label class="form-check-label fw-medium" for="car-{{ $loop->index }}">
                                                    รถ {{ $loop->iteration }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="invalid-feedback d-block">กรุณาเลือกรถที่ต้องการใช้</div>
                    </div>

                    <!-- ข้อมูลผู้ขอใช้รถ -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fas fa-user-tie me-2"></i>ข้อมูลผู้ขอใช้รถ
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-user me-1 text-muted"></i>ชื่อ-สกุล
                                </label>
                                <input type="text" name="name" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกชื่อ-สกุล</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-briefcase me-1 text-muted"></i>ตำแหน่ง
                                </label>
                                <input type="text" name="position" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกตำแหน่ง</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-users me-1 text-muted"></i>กลุ่ม/ฝ่าย
                                </label>
                                <input type="text" name="department" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกกลุ่ม/ฝ่าย</div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลการเดินทาง -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fas fa-map-marked-alt me-2"></i>ข้อมูลการเดินทาง
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-muted"></i>สถานที่ไป
                                </label>
                                <input type="text" name="destination" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกสถานที่ไป</div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-city me-1 text-muted"></i>จังหวัด
                                </label>
                                <input type="text" name="province" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกจังหวัด</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-bullseye me-1 text-muted"></i>วัตถุประสงค์
                                </label>
                                <input type="text" name="purpose" class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกวัตถุประสงค์</div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลรถและคนขับ -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fas fa-info-circle me-2"></i>ข้อมูลรถและคนขับ
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-users me-1 text-muted"></i>จำนวนคนนั่ง
                                </label>
                                <div class="input-group shadow-sm">
                                    <input type="text" name="seats" id="seats" class="form-control"
                                        maxlength="2" required>
                                    <span class="input-group-text bg-light">คน</span>
                                </div>
                                <div class="invalid-feedback">กรุณากรอกจำนวนคนนั่ง</div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-car me-1 text-muted"></i>ยี่ห้อรถ
                                </label>
                                <input type="text" name="car_name" class="form-control shadow-sm" required readonly>
                                <div class="invalid-feedback">กรุณาเลือกรถ</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-id-card-alt me-1 text-muted"></i>ทะเบียนรถ
                                </label>
                                <input type="text" name="car_registration" class="form-control shadow-sm" required
                                    readonly>
                                <div class="invalid-feedback">กรุณาเลือกรถ</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-user-shield me-1 text-muted"></i>พนักงานขับรถ
                                </label>
                                <input type="text" name="driver" class="form-control shadow-sm" required readonly>
                                <div class="invalid-feedback">กรุณาเลือกรถ</div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลวันเวลา -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="far fa-clock me-2"></i>กำหนดการ
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day me-1 text-muted"></i>วันเวลาที่ประชุม
                                </label>
                                <input type="text" id="meeting_datetime" name="meeting_datetime"
                                    class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกวันเวลาที่ประชุม</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-car-side me-1 text-muted"></i>เวลาที่ขอรถ
                                </label>
                                <input type="text" id="car_request_time" name="car_request_time"
                                    class="form-control shadow-sm" required>
                                <div class="invalid-feedback">กรุณากรอกเวลาที่ขอรถ</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-sign-out-alt me-1 text-muted"></i>วันเวลาไป
                                </label>
                                <input type="text" id="start_time" name="start_time" class="form-control shadow-sm"
                                    required>
                                <div class="invalid-feedback">กรุณากรอกวันเวลาไป</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-sign-in-alt me-1 text-muted"></i>วันเวลากลับ
                                </label>
                                <input type="text" id="end_time" name="end_time" class="form-control shadow-sm"
                                    required>
                                <div class="invalid-feedback">กรุณากรอกวันเวลากลับ</div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลเพิ่มเติม -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fas fa-paperclip me-2"></i>ข้อมูลเพิ่มเติม
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-file-upload me-1 text-muted"></i>ไฟล์แนบ
                                </label>
                                <input type="file" name="attachment" class="form-control shadow-sm"
                                    accept="image/*,.pdf,.doc,.docx">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-comment-dots me-1 text-muted"></i>เหตุผล (ถ้ามี)
                                </label>
                                <textarea name="reason" class="form-control shadow-sm" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่มส่งคำขอ -->
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-sm fw-bold">
                            <i class="fas fa-paper-plane me-2"></i>ส่งคำขอใช้รถ
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
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border-bottom: none;
        }

        .car-option {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .car-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .form-check-input:checked+.form-check-label {
            color: #0d6efd;
            font-weight: bold;
        }

        .form-control,
        .input-group-text {
            border-radius: 8px !important;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) !important;
        }

        .btn-success {
            background-color: #198754;
            border-color: #198754;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #157347;
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(25, 135, 84, 0.3) !important;
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }
    </style>
@endpush

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

    <script>
        // ฟังก์ชันแปลงเป็นวันที่ไทย
        function formatBuddhistDate(dateObj) {
            const buddhistYear = dateObj.getFullYear() + 543;
            const monthNames = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.',
                'ธ.ค.'
            ];
            return `${dateObj.getDate()} ${monthNames[dateObj.getMonth()]} ${buddhistYear} ${dateObj.getHours().toString().padStart(2, '0')}:${dateObj.getMinutes().toString().padStart(2, '0')}`;
        }

        // ตั้งค่าปฏิทิน
        function initThaiDatepicker(id) {
            flatpickr(id, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                locale: "th",
                altInput: true,
                altFormat: "j M Y H:i",
                minDate: "today", // ❗ ไม่ให้จองย้อนหลัง
                maxDate: new Date().fp_incr(7), // ❗ จำกัดล่วงหน้าไม่เกิน 7 วัน
                onReady: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance.altInput.value = formatBuddhistDate(selectedDates[0]);
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance.altInput.value = formatBuddhistDate(selectedDates[0]);
                    }
                    validateDateRange();
                }
            });
        }
        // เรียกใช้ปฏิทิน
        document.addEventListener('DOMContentLoaded', function() {
            initThaiDatepicker("#meeting_datetime");
            initThaiDatepicker("#car_request_time");
            initThaiDatepicker("#start_time");
            initThaiDatepicker("#end_time");

            // ข้อมูลรถและคนขับ
            const carData = {
                '7500_Moto3.jpg': {
                    name: 'Toyota Fortuner',
                    registration: 'กข-1324 กรุงเทพฯ',
                    driver: 'นายสมชาย ใจดี'
                },
                'images1.jpg': {
                    name: 'Honda Civic',
                    registration: 'ขย-8976 เชียงใหม่',
                    driver: 'นางสาวสุดา โครตช้า'
                },
                'images2.jpg': {
                    name: 'Isuzu D-Max',
                    registration: 'คง-9908 ขอนแก่น',
                    driver: 'นายสมหมาย หวังดี'
                },
                'images4.jpg': {
                    name: 'Mazda CX-5',
                    registration: 'ตต-5466 นครราชสีมา',
                    driver: 'นางสาวจันทร์เพ็ญ ทองปลอม'
                }
            };

            // เมื่อเลือกรถ
            document.querySelectorAll('input[name="car_image"]').forEach(input => {
                input.addEventListener('change', function() {
                    const selectedCar = this.value;
                    const carInfo = carData[selectedCar];

                    if (carInfo) {
                        document.querySelector('input[name="car_name"]').value = carInfo.name;
                        document.querySelector('input[name="car_registration"]').value = carInfo
                            .registration;
                        document.querySelector('input[name="driver"]').value = carInfo.driver;
                    }
                });
            });

            // จำกัดจำนวนคนนั่งให้เป็นตัวเลข 2 หลัก
            const seatsInput = document.getElementById('seats');
            seatsInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 2) {
                    this.value = this.value.slice(0, 2);
                }
            });

            // Bootstrap validation
            (function() {
                'use strict'
                const forms = document.querySelectorAll('.needs-validation')

                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        });
    </script>
@endpush
