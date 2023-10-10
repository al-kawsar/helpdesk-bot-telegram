<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;

class DashboardController extends Controller
{

    public function pageIndex()
    {
        $title = 'Home';
        $teks = 'anjay';
        $lists = Pertanyaan::orderBy('total_pertanyaan', 'desc') // Mengurutkan berdasarkan total_pertanyaan secara descending (terbesar ke terkecil)
            ->limit(6) // Membatasi jumlah hasil yang diambil menjadi 6
            ->get();
        return view('v_home', compact('title', 'teks', 'lists'));
    }
}
