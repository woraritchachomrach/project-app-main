<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ฟอร์มคำขอใช้รถ</title>
    <style>
        body {
            font-family: 'TH Sarabun New', sans-serif;
            font-size: 18px;
            margin: 2cm;
        }
        h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        .field-label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }
        .section {
            margin-bottom: 15px;
        }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>
    <h3>แบบฟอร์มคำขอใช้รถราชการ</h3>

    <div class="section"><span class="field-label">ชื่อผู้ขอ:</span> {{ $request->name }}</div>
    <div class="section"><span class="field-label">ตำแหน่ง:</span> {{ $request->position }}</div>
    <div class="section"><span class="field-label">กลุ่ม/หน่วยงาน:</span> {{ $request->department }}</div>
    <div class="section"><span class="field-label">จำนวนคนนั่ง:</span> {{ $request->seats }} คน</div>
    <div class="section"><span class="field-label">สถานที่:</span> {{ $request->destination }}</div>
    <div class="section"><span class="field-label">วันเวลาเดินทาง:</span>
        {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y H:i') }} ถึง 
        {{ \Carbon\Carbon::parse($request->end_time)->format('d/m/Y H:i') }}
    </div>
    <div class="section"><span class="field-label">ทะเบียนรถ:</span> {{ $request->car_registration }}</div>
    <div class="section"><span class="field-label">พนักงานขับรถ:</span> {{ $request->driver ?? '-' }}</div>
    <div class="section"><span class="field-label">เหตุผล:</span> {{ $request->reason ?? '-' }}</div>

    <br><br><br>

    <div class="section">
        ลงชื่อผู้ขอ.................................................... วันที่............................
    </div>
    <div class="section">
        ความเห็นผู้อนุมัติ: ............................................................................
    </div>

    <button onclick="window.print()">พิมพ์หน้านี้</button>
</body>
</html>
