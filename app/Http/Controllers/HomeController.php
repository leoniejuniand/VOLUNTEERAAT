<?php

namespace App\Http\Controllers;

use App\Models\Event; // Pastikan model Event di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 3 kegiatan terbaru yang akan ditampilkan di landing page
        $kegiatan = Event::latest()->take(3)->get();
        
        // Kirim data ke view landing page (misal: welcome.blade.php)
        return view('welcome', compact('kegiatan')); 
    }
}