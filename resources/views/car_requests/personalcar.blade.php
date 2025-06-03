@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center text-primary fw-bold">🚗 ฟอร์มขอใช้รถส่วนตัว</h2>

        {{-- แสดงข้อความสำเร็จ --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- แสดง error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('personal-car-requests.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">ชื่อ-สกุล</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">ตำแหน่ง</label>
                    <input type="text" name="position" class="form-control" required value="{{ old('position') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">แผนก / กลุ่ม</label>
                    <input type="text" name="department" class="form-control" required value="{{ old('department') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">ยี่ห้อรถ</label>
                    <input type="text" name="car_brand" class="form-control" required value="{{ old('car_brand') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">ทะเบียนรถ</label>
                    <input type="text" name="car_registration" class="form-control" required
                        value="{{ old('car_registration') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">จำนวนที่นั่ง</label>
                    <input type="number" name="seats" class="form-control" required value="{{ old('seats') }}">
                </div>

                <div class="col-md-9">
                    <label class="form-label">สถานที่ไป</label>
                    <input type="text" name="destination" class="form-control" required
                        value="{{ old('destination') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">จังหวัด</label>
                    <input type="text" name="province" class="form-control" required value="{{ old('province') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">วัตถุประสงค์</label>
                    <input type="text" name="purpose" class="form-control" required value="{{ old('purpose') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">เวลาออกเดินทาง</label>
                    <input type="text" name="start_time" id="start_time" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">เวลากลับ</label>
                    <input type="text" name="end_time" id="end_time" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">เหตุผลเพิ่มเติม (ถ้ามี)</label>
                    <textarea name="reason" class="form-control" rows="3">{{ old('reason') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">แนบไฟล์ (ถ้ามี)</label>
                    <input type="file" name="attachment" class="form-control">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-5 py-2 rounded-pill">
                    <i class="fas fa-paper-plane me-2"></i>ส่งคำขอใช้รถส่วนตัว
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
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
                altFormat: "j M Y H:i",
                minDate: "today",
                maxDate: new Date().fp_incr(30), // กำหนดล่วงหน้าได้ 30 วัน
                onReady: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance.altInput.value = formatBuddhistDate(selectedDates[0]);
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length) {
                        instance.altInput.value = formatBuddhistDate(selectedDates[0]);
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initThaiDatepicker("#start_time");
            initThaiDatepicker("#end_time");
        });
    </script>
@endpush
