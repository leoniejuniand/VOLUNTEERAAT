<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download(EventRegistration $registration)
    {
        // 1. Keamanan: Pastikan relawan hanya bisa unduh sertifikat miliknya sendiri
        if ($registration->user_id != Auth::id()) {
            abort(403, 'Akses ditolak. Ini bukan data pendaftaran Anda.');
        }

        // 2. Validasi Syarat Sertifikat: Diterima, Hadir, dan Kegiatan Selesai
        if ($registration->status != 'Diterima' || !$registration->is_present || $registration->event->status != 'Selesai') {
            abort(403, 'Sertifikat belum tersedia. Pastikan kegiatan sudah selesai dan Anda tercatat hadir.');
        }

        // 3. Render HTML ke PDF (menggunakan ukuran kertas A4 model landscape)
        $pdf = Pdf::loadView('events.certificate', compact('registration'))
                  ->setPaper('a4', 'landscape');

        // 4. Unduh file PDF-nya
        $namaFile = 'Sertifikat_Relawan_' . Auth::user()->name . '.pdf';
        return $pdf->download($namaFile);
    }
}