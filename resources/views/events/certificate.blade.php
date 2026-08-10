<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Sertifikat Relawan</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            text-align: center;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .container {
            border: 15px solid #4f46e5;
            padding: 50px;
            margin: 30px;
            background-color: #ffffff;
            height: 550px;
            position: relative;
        }
        .header {
            font-size: 45px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }
        .sub-header {
            font-size: 20px;
            color: #6b7280;
            margin-bottom: 40px;
        }
        .awarded-to {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .name {
            font-size: 40px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }
        .description {
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 40px;
        }
        .event-title {
            font-size: 26px;
            font-weight: bold;
            color: #111827;
        }
        .footer {
            position: absolute;
            bottom: 50px;
            width: 100%;
            left: 0;
        }
        .signature-box {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }
        .signature-line {
            border-bottom: 2px solid #1f2937;
            margin-bottom: 10px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">PIAGAM PENGHARGAAN</div>
        <div class="sub-header">Diberikan secara resmi oleh Yayasan AAT Indonesia kepada:</div>
        
        <div class="name">{{ strtoupper($registration->user->name) }}</div>
        
        <div class="description">
            Atas dedikasi, waktu, dan tenaga yang telah diberikan sebagai <strong>Relawan</strong> dalam kegiatan:<br>
            <span class="event-title">"{{ $registration->event->title }}"</span><br><br>
            Yang diselenggarakan di {{ $registration->event->location }}<br>
            pada tanggal {{ \Carbon\Carbon::parse($registration->event->event_date)->format('d F Y') }}.
        </div>

        <div class="footer">
            <div class="signature-box">
                <div>Sekretariat {{ $registration->event->secretariat->name }}, {{ \Carbon\Carbon::parse($registration->event->event_date)->format('d F Y') }}</div>
                <div class="signature-line"></div>
                <strong>Ketua Pelaksana</strong>
            </div>
        </div>
    </div>
</body>
</html>