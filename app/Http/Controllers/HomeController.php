<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;
use App\Models\Kalimat;

class HomeController extends Controller
{
    public function index(){
        // Ambil semua data kata dan kalimat
        $kataList = Kata::all();
        $kalimatList = Kalimat::all();

        // Gabungkan kalimat berdasarkan sub_id (id_kata)
        $kalimatGrouped = $kalimatList->groupBy('sub_id');

        // Bangun struktur utama
        $wordData = $kataList->whereNull('id_sub')->map(function ($kata) use ($kataList, $kalimatGrouped) {
            return $this->formatKata($kata, $kataList, $kalimatGrouped);
        })->values();

        // Kirim ke view
        return view('home', ['wordData' => json_encode($wordData)]);
    }

    private function formatKata($kata, $kataList, $kalimatGrouped){
        $turunan = $kataList->where('id_sub', $kata->id_kata)->map(function ($sub) use ($kataList, $kalimatGrouped) {
            return $this->formatKata($sub, $kataList, $kalimatGrouped);
        })->values();

        $contoh = [];
        if (isset($kalimatGrouped[$kata->id_kata])) {
            $contoh = $kalimatGrouped[$kata->id_kata]->map(function ($kalimat) {
                return [
                    'Besemah' => $kalimat->kalimat,
                    'indonesia' => $kalimat->arti_kalimat,
                ];
            })->values();
        }

        return [
            'kata' => $kata->kata,
            'caraBaca' => $kata->cara_baca,
            'jenis' => $this->convertJenisShort($kata->kategori_kata),
            'arti' => $kata->definisi,
            'contoh' => $contoh,
            'turunan' => $turunan->isNotEmpty() ? $turunan : null,
        ];
    }

    private function convertJenisShort($kategori){
        return match ($kategori) {
            'kata_benda' => 'n',
            'kata_kerja' => 'v',
            'kata_sifat' => 'adj',
            'kata_keterangan' => 'adv',
            'kata_ganti' => 'pron',
            default => '',
        };
    }
}
