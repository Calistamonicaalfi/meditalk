<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Doctor;
use App\Models\Schedule;

class PublicController extends Controller
{
    // Beranda
    public function home()
    {
        $dokter = Doctor::limit(6)->get(); // Ambil 6 data dokter
        $articles = Article::orderBy('created_at', 'desc')->limit(6)->get();

        return view('public.home', compact('dokter', 'articles'));
    }

    // Halaman semua artikel
    public function artikel()
    {
        $artikel = Article::latest()->get();
        return view('public.artikel.index', compact('artikel'));
    }

    // Halaman semua dokter dengan jadwal
    public function dokter()
    {
        $dokter = Doctor::with('schedules')->get();
        return view('public.dokter.index', compact('dokter'));
    }

    // Alternatif list dokter (bisa digunakan sesuai kebutuhan)
    public function listDokter()
    {
        $dokter = Doctor::all();
        return view('public.dokter.index', compact('dokter'));
    }

    // Detail artikel
    public function showArtikel($id)
    {
        $artikel = Article::findOrFail($id);
        return view('public.artikel.detail', compact('artikel'));
    }

    // Detail dokter
    public function showDokter($id)
    {
        $dokter = Doctor::with('schedules')->findOrFail($id);
        return view('public.dokter.detail', compact('dokter'));
    }
}
