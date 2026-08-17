<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RegistrationStatusNotification extends Notification
{
    use Queueable;

    protected $eventTitle;
    protected $status;

    // Menerima data judul kegiatan dan status baru
    public function __construct($eventTitle, $status)
    {
        $this->eventTitle = $eventTitle;
        $this->status = $status;
    }

    // Mengatur agar notifikasi HANYA disimpan ke tabel database (tidak dikirim ke email)
    public function via(object $notifiable): array
    {
        return ['database']; 
    }

    // Mengatur isi teks notifikasi yang akan muncul di layar
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Update Status Pendaftaran',
            'message' => 'Status pendaftaran Anda pada kegiatan "' . $this->eventTitle . '" telah diubah menjadi: ' . $this->status,
            'url' => route('dashboard'), // URL tujuan saat notifikasi diklik
            'icon' => 'bell'
        ];
    }
}