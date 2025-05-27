@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm bg-light">
            <div class="card-body">
                <h3 class="mb-4 text-center text-primary">📋แบบฟอร์มขอรถราชการ</h3>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('car-requests.store') }}">
                    <!--ส่งข้อมูลแบบ POST ไปยัง route ที่ชื่อ car-requests.store ถ้าใช้postให้เก็บstoreถ้าgetให้เก็บindexหรือชื่อไฟล์ที่ตั้ง-->
                    @csrf

                    <div class="mb-4">
                        <label class="form-label d-block fw-bold">เลือกรถที่ต้องการใช้</label>
                        <div class="row">
                            @foreach (['7500_Moto3.jpg', 'images1.jpg', 'images2.jpg', 'images4.jpg'] as $car)
                                <!--วนลูปแสดงรถ 4 คัน (ภาพไฟล์ .jpg) จาก array ที่กำหนดไว้ในลูป-->
                                <div class="col-md-3 col-sm-6 mb-3 text-center">
                                    <label class="d-block">
                                        <input type="radio" name="car_image" value="{{ $car }}" required
                                            class="form-check-input me-2">
                                        <img src="{{ asset('storage/images/' . $car) }}"
                                            class="img-thumbnail shadow-sm rounded"
                                            style="width: 90%; height: 150px; object-fit: cover;">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ชื่อ</label>
                            <input type="text" name="name" class="form-control rounded" placeholder="ชื่อ" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ตำแหน่ง</label>
                            <input type="text" name="position" class="form-control rounded" placeholder="ตำแหน่ง"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">กลุ่ม</label>
                            <input type="text" name="department" class="form-control rounded" placeholder="กลุ่ม"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">สถานที่</label>
                            <input type="text" name="destination" class="form-control rounded" placeholder="สถานที่"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">เพื่อ(ไปทำอะไร)</label>
                            <input type="text" name="destination" class="form-control rounded" placeholder="เพื่ออะไร"
                                required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">จำนวนคนนั่ง</label>
                            <div class="input-group">
                                <input type="text" name="seats" id="seats" class="form-control rounded"
                                    placeholder="จำนวนคนนั่ง" maxlength="2" required>
                                <span class="input-group-text rounded-end">คน</span>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">รถ</label>
                            <input type="text" name="destination" class="form-control rounded" placeholder="รถ" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">ทะเบียนรถ</label>
                            <input type="text" name="car_registration" class="form-control rounded"
                                placeholder="พนักงานขับรถยนต์" required readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">พนักงานขับรถยนต์</label>
                            <input type="text" name="driver" class="form-control rounded" placeholder="พนักงานขับรถยนต์"
                                required readonly>

                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">วันเวลาที่ประชุม</label>
                            <input type="time" id="start_time" name="start_time" class="form-control rounded" required>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">เวลาที่ขอรถ</label>
                            <input type="time" id="start_time" name="start_time" class="form-control rounded" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">วันเวลา(ไป)</label>
                            <input type="text" id="start_time" name="start_time" class="form-control rounded" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">วันเวลา(กลับ)</label>
                            <input type="text" id="end_time" name="end_time" class="form-control rounded" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">เหตุผล (ถ้ามี)</label>
                            <textarea name="reason" class="form-control rounded" rows="6" placeholder="เหตุผล (ถ้ามี)"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
                            🚗 ส่งคำขอ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

    <script>
        function formatBuddhistDate(dateObj) {
            const buddhistYear = dateObj.getFullYear() + 543;
            const monthNames = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.',
                'ธ.ค.'
            ];
            return `${dateObj.getDate()} ${monthNames[dateObj.getMonth()]} ${buddhistYear} ${dateObj.getHours().toString().padStart(2, '0')}:${dateObj.getMinutes().toString().padStart(2, '0')}`;
        }

        function initThaiDatepicker(id) {
            flatpickr(id, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                locale: "th",
                altInput: true,
                altFormat: "J M Y H:i",
                onReady: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance._input.value = formatBuddhistDate(selectedDates[0]);
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance._input.value = formatBuddhistDate(selectedDates[0]);
                    }
                }
            });
        }

        initThaiDatepicker("#start_time");
        initThaiDatepicker("#end_time");

        // ✅ เพิ่มสคริปต์นี้ fig รถและพนักงานขับรถ และ ทะเบียนรถ
        const carData = {
            '7500_Moto3.jpg': {
                registration: 'กข-1324 กรุงเทพฯ',
                driver: 'นายสมชาย ใจดี'
            },
            'images1.jpg': {
                registration: 'ขย-8976 เชียงใหม่',
                driver: 'นางสาวสุดา โครตช้า'
            },
            'images2.jpg': {
                registration: 'คง-9908 ขอนแก่น',
                driver: 'นายสมหมาย หวังดี'
            },
            'images4.jpg': {
                registration: 'ตต-5466 นครราชสีมา',
                driver: 'นางสาวจันทร์เพ็ญ ทองปลอม'
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[name="car_image"]').forEach(input => {
                input.addEventListener('change', function() {
                    const selectedCar = this.value;
                    const carInfo = carData[selectedCar];

                    if (carInfo) {
                        document.querySelector('input[name="car_registration"]').value = carInfo
                            .registration;
                        document.querySelector('input[name="driver"]').value = carInfo.driver;
                    }
                });
            });
        });
    </script>



    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const seatsInput = document.getElementById('seats');

                seatsInput.addEventListener('input', function() {
                    // ลบทุกอย่างที่ไม่ใช่ตัวเลข
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // จำกัดความยาวไม่เกิน 2 หลัก
                    if (this.value.length > 2) {
                        this.value = this.value.slice(0, 2);
                    }
                });
            });
        </script>
    @endpush
@endsection
