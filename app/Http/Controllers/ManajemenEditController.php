<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;
use App\Models\Kalimat;

class ManajemenEditController extends Controller
{
    public function index(){
        $kata = Kata::where('status', 'Menunggu')->get()->map(function ($k) {
            return [
                'idData'   => strtoupper($k->id_kata),
                'subId'    => ($k->id_sub ? $k->id_sub : '-'),
                'konten'   => $k->kata,
                'caraBaca' => $k->cara_baca ?? '-',
                'arti'     => $k->definisi,
                'tipe'     => 'Kata',
                'jenis'    => $k->kategori_kata ? $this->convertJenisFull($k->kategori_kata) : '-',
                'status'   => strtoupper($k->status ?? 'PENDING'),
            ];
        });
        
        $kalimat = Kalimat::where('status', 'Menunggu')->get()->map(function ($k) {
            // cari kata utama (sub_id) agar bisa ditampilkan di subId
            $kata = Kata::where('id_kata', $k->sub_id)->first();
            $subTeks = $kata ? ($kata->id_kata)  : '-';
        
            return [
                'idData'   => strtoupper($k->id_kalimat),
                'subId'    => $subTeks,
                'konten'   => $k->kalimat,
                'caraBaca' => '-',
                'arti'     => $k->arti_kalimat,
                'tipe'     => 'Kalimat',
                'jenis'    => '-',
                'status'   => strtoupper($k->status ?? 'PENDING'),
            ];
        });
        
        $dataGabungan = collect([...$kata, ...$kalimat]);
        return view('kontributor.manajemen-edit', compact('dataGabungan'));
    }

    private function convertJenisFull($kategori){
        return match ($kategori) {
            'kata_benda'        => 'Nomina',
            'kata_kerja'        => 'Verba',
            'kata_sifat'        => 'Adjektiva',
            'kata_keterangan'   => 'Adverbia',
            'kata_ganti'        => 'Pronomina',
            default             => '',
        };
    }
}
