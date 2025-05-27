<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบขออนุญาตใช้รถยนต์ราชการ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;700&display=swap');
        
        body {
            font-family: 'Sarabun', sans-serif;
            font-weight: 10; /* ปรับให้หนากว่าปกติ */
            font-size: 13pt;
            line-height: 1.5;
            padding: 20px;
        }

        * {
            unicode-bidi: embed;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .center {
            text-align: center;
            margin-bottom: 20px;
        }

        .right {
            text-align: right;
            margin-bottom: 20px;
        }

        .section {
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .underline {
            display: inline-block;
            border-bottom: 1px dotted #000;
            min-width: 100px;
            padding: 0 5px;
            text-align: center;
            height: 1.5em;
        }

        .signature {
            margin-top: 2em;
            margin-bottom: 1em;
        }

        .title {
            font-size: 20pt;
            font-weight: 700; /* หัวเรื่องหนา */
            margin-bottom: 10px;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            margin: 10px 0;
        }

        .signature-line {
            display: inline-block;
            width: 200px;
            border-bottom: 1px dotted #000;
            margin-top: 50px;
        }

        .footer {
            margin-top: 30px;
            font-size: 14pt;
        }
    </style>
</head>
<body>

    <div class="center">
        <div class="title">ใบขออนุญาตใช้รถยนต์ราชการ</div>
        <div>ศูนย์อนามัยที่ 8 อุดรธานี</div>
    </div>

    <div class="right">
        วันที่ <span class="underline">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
    </div>

    <div class="section">
        เรียน ผู้อำนวยการศูนย์อนามัยที่ 8 อุดรธานี
    </div>

    <div class="section">
        ข้าพเจ้า <span class="underline">{{ $request->name }}</span>
        ตำแหน่ง <span class="underline">{{ $request->position }}</span><br>
        ขออนุญาตใช้รถยนต์ราชการไปปฏิบัติราชการ ณ <span class="underline">{{ $request->destination }}</span><br>
        จังหวัด <span class="underline">{{ $request->province }}</span>
        จำนวน <span class="underline">{{ $request->seats }}</span> คน<br>
        ตั้งแต่วันที่ <span class="underline">{{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y') }}</span>
        เวลา <span class="underline">{{ \Carbon\Carbon::parse($request->start_time)->format('H:i') }}</span> น.
        ถึงเวลา <span class="underline">{{ \Carbon\Carbon::parse($request->end_time)->format('H:i') }}</span> น.
    </div>

    <div class="section right signature">
        ลงชื่อ<span class="signature-line">{{ $request->name}}</span>ผู้ขออนุญาต
    </div>

    <div class="section">
        ลงชื่อ<span class="signature-line"></span>หัวหน้ากลุ่มงาน/ฝ่าย/ผู้ที่ได้รับหมาย<br>       
    </div>

    <div class="section">
        อนุญาติให้<span class="signature-line">{{ $request->name}}</span><span>พนักงานขับรถรถยนต์เป็นผู้ขับขี่ไปราชการดังกล่าว</span>
        โดยใช้รถยนต์ราชการคันหมายเลขทะเบียน<span class="signature-line">{{ $request->car_registration}}</span>
    </div>

    <div class="section">
        ลงชื่อ<span class="signature-line"></span>ผู้จัดรถยนต์<br>
        (<span class="underline"></span>)
    </div>

    <div class="section">
        ลงชื่อ<span class="signature-line"></span>ผู้อนุญาต/ผู้ได้รับมอบหมาย<br>
        (<span class="underline"></span>)<br>
        <div>   </div>
    </div>

    <div class="section">
        <strong>หมายเหตุ:</strong><br>
        1. การขอใช้รถยนต์ต้องเสนอให้ผู้มีอำนาจลงนามล่วงหน้าอย่างน้อย 1 วัน ยกเว้นกรณีเร่งด่วน<br>
        2. หากมีการเปลี่ยนแปลงกำหนดการเดินทาง เช่น เวลา หรือยกเลิก กรุณาแจ้งให้ทราบล่วงหน้า<br>
        3. หากพนักงานขับรถไม่ปฏิบัติงาน หรือประพฤติตัวไม่เหมาะสม ขอให้รายงานเป็นลายลักษณ์อักษร
    </div>

    <div class="section right footer">
        เลขบันทึก: <span class="underline">{{ $request->reference_number }}</span><br>
        เลขใบเสร็จ: <span class="underline">{{ $request->receipt_number}}</span>
    </div>

</body>
</html>
