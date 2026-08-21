<?php

namespace App\Http\Controllers;

use App\Models\Event; // Pastikan model Event di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    // Mengambil beberapa kegiatan terbaru yang statusnya 'Buka'
    $kegiatan = Event::where('status', 'Buka')->latest()->take(3)->get();
    
    return view('welcome', compact('kegiatan'));
}
}