    @extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary fw-bold">แบบบันทึกการใช้รถราชการ</h3>

        <form action="{{ route('car-usage.store') }}" method="POST" class="border rounded p-4 shadow bg-white">
            @csrf

            {{-- แถวที่ 1 --}}
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="sequence" class="form-label fw-semibold">ลำดับ</label>
                    <input type="number" name="sequence" id="sequence" class="form-control" placeholder="ลำดับ">
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label fw-semibold">วันที่ออกเดินทาง</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="time" class="form-label fw-semibold">เวลา</label>
                    <input type="time" name="time" id="time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="user_name" class="form-label fw-semibold">ผู้ใช้รถ</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="ชื่อผู้ใช้" required>
                </div>
            </div>

            {{-- แถวที่ 2 --}}
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="destination" class="form-label fw-semibold">สถานที่ไป</label>
                    <input type="text" name="destination" id="destination" class="form-control" placeholder="จุดหมายปลายทาง" required>
                </div>
                <div class="col-md-2">
                    <label for="start_mileage" class="form-label fw-semibold">เลขไมล์เมื่อออก</label>
                    <input type="text" name="start_mileage" id="start_mileage" class="form-control" placeholder="เลขไมล์เริ่มต้น" required>
                </div>
                <div class="col-md-4">
                    <label for="driver_name" class="form-label fw-semibold">พนักงานขับรถ</label>
                    <input type="text" name="driver_name" id="driver_name" class="form-control" placeholder="ชื่อพนักงานขับรถ" required>
                </div>
            </div>

            {{-- แถวที่ 3 --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="return_date" class="form-label fw-semibold">วันที่กลับถึงสำนักงาน</label>
                    <input type="date" name="return_date" id="return_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="return_time" class="form-label fw-semibold">เวลากลับ</label>
                    <input type="time" name="return_time" id="return_time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="end_mileage" class="form-label fw-semibold">เลขไมล์เมื่อกลับ</label>
                    <input type="text" name="end_mileage" id="end_mileage" class="form-control" placeholder="เลขไมล์ตอนกลับ" required>
                </div>
            </div>
                {{-- แถวที่ 4 --}}
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="total_distance" class="form-label fw-semibold">รวมระยะทาง (กม./ไมล์)</label>
                        <input type="text" name="total_distance" id="total_distance" class="form-control bg-light" placeholder="ระบบจะคำนวณอัตโนมัติ" readonly>
                    </div>
                </div>

                {{-- แถวที่ 5 - หมายเหตุ (ย้ายลงมาล่างสุด) --}}
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="notes" class="form-label fw-semibold">หมายเหตุ</label>
                        <textarea name="notes" id="notes" class="form-control" placeholder="ระบุเพิ่มเติม (ถ้ามี)" rows="10"></textarea>
                    </div>
                </div>

                {{-- ปุ่มบันทึก --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 py-2">บันทึกข้อมูล</button>
                </div>
        </form>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startMileage = document.getElementById('start_mileage');
        const endMileage = document.getElementById('end_mileage');
        const totalDistance = document.getElementById('total_distance');

        function calculateDistance() {
            const start = parseFloat(startMileage.value);
            const end = parseFloat(endMileage.value);

            if (!isNaN(start) && !isNaN(end) && end >= start) {
                const distance = end - start;
                totalDistance.value = distance.toFixed(2);
            } else {
                totalDistance.value = '';
            }
        }

        startMileage.addEventListener('input', calculateDistance);
        endMileage.addEventListener('input', calculateDistance);
    });
</script>
@endpush



    @endsection
