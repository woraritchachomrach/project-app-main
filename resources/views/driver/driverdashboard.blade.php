@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>งานที่ได้รับมอบหมาย</h2>

        @if ($requests->isEmpty())
            <p>ยังไม่มีงานที่ได้รับมอบหมาย</p>
        @else
            <ul class="list-group">
                @foreach ($requests as $request)
                    <li class="list-group-item">
                        <strong>ผู้ขอ:</strong> {{ $request->name }}<br>
                        <strong>ปลายทาง:</strong> {{ $request->destination }}<br>
                        <strong>คนขับ</strong> {{ $request->driver}}<br>
                        <strong>ทะเบียน:</strong> {{ $request->car_registration ?? '-' }}<br>
                        <strong>วันที่:</strong> {{ $request->start_time }} ถึง {{ $request->end_time }}

                            {{-- แสดงรูปรถ --}}
                    @if ($request->car && $request->car_image)
                        <img src="{{ asset('storage/' . $request->car_image) }}" alt="รูปรถ" width="200">
                    @else
                        <p>ไม่มีรูปรถ</p>
                    @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
