@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">📋 งานที่ได้รับมอบหมาย</h2>

        @if ($requests->isEmpty())
            <div class="alert alert-info text-center">
                ยังไม่มีงานที่ได้รับมอบหมาย
            </div>
        @else
            <!-- 🔍 ช่องค้นหา -->
            <div class="mb-4">
                <input type="text" id="jobSearch" class="form-control" placeholder="🔍 ค้นหาสถานที่, วัตถุประสงค์ หรือชื่อผู้ขอ...">
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4" id="jobCards">
                @foreach ($requests as $request)
                    @php
                        $driverUser = \App\Models\User::where('name', $request->driver)->first();
                    @endphp

                    <div class="col job-card">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5>🧾 งานวันที่ {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y') }}</h5>
                                    <span class="badge bg-info text-dark">
                                        {{ \Carbon\Carbon::parse($request->start_time)->format('d M Y H:i') }}
                                    </span>
                                </div>

                                <p class="mb-2"><strong>📍 สถานที่:</strong> {{ $request->destination }}</p>

                                <ul class="list-unstyled small mb-0">
                                    <li><strong>🔑 รหัสคนขับ:</strong> {{ $driverUser->code ?? '-' }}</li>
                                    <li><strong>👤 ผู้ขอ:</strong> {{ $request->name }}</li>
                                    <li><strong>📞 เบอร์ผู้ขอ:</strong> {{ $request->requester_phone ?? '-' }}</li>
                                    <li><strong>📝 เรื่อง:</strong> {{ $request->purpose }}</li>
                                    <li><strong>🕒 เวลาประชุม:</strong> {{ \Carbon\Carbon::parse($request->meeting_datetime)->format('d/m/Y H:i') }}</li>
                                    <li><strong>🧑‍🤝‍🧑 จำนวนคนนั่ง:</strong> {{ $request->seats }} คน</li>
                                    <li><strong>🚗 รถ:</strong> {{ $request->car_name }}</li>
                                    <li><strong>📄 ทะเบียน:</strong> {{ $request->car_registration ?? '-' }}</li>
                                    <li><strong>👨‍✈️ คนขับ:</strong> {{ $request->driver }}</li>
                                    <li><strong>🧭 จังหวัด:</strong> {{ $request->province }}</li>
                                    <li><strong>📆 ไป-กลับ:</strong>
                                        {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y H:i') }}
                                        ถึง
                                        {{ \Carbon\Carbon::parse($request->end_time)->format('d/m/Y H:i') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('jobSearch');
        const jobCards = document.querySelectorAll('.job-card');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();

            jobCards.forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.includes(keyword) ? 'block' : 'none';
            });
        });
    });
</script>
@endpush
