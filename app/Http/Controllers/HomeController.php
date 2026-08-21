<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 kegiatan terbaru dari tabel events
        $kegiatan = Event::latest()
            ->take(6)
            ->get();

        return view('welcome', compact('kegiatan'));
    }

    // Detail kegiatan untuk pengunjung umum
    public function show(Event $event)
    {
        return view('event-detail', compact('event'));
    }
}