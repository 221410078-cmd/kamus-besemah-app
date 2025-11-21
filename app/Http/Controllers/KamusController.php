<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;

class KamusController extends Controller
{
    public function index(){
        $kata = Kata::whereIn('jenis_kata', ['utama', 'turunan'])->whereIn('status', ['Disetujui', 'Ditolak'])->with([
        'sub',
        'turunan' => function($q) {
            $q->with('kalimat');
        },
        'kalimat'
    ])
    ->get();


    $result = [];

    foreach ($kata as $k) {

        $item = [
            'kata' => $k->kata,
            'caraBaca' => $k->cara_baca,
            'jenis' => $this->convertJenis($k->kategori_kata),
            'arti' => $k->definisi,
            'status' => $k->status === 'Disetujui' ? 'Valid' : ($k->status === 'Ditolak' ? 'Rejected' : 'Pending'),
            'tanggalDitambahkan' => $k->created_at->format('Y-m-d'),
            'contoh' => []
        ];

        // contoh kalimat kata utama
        foreach ($k->kalimat as $kl) {
            $item['contoh'][] = [
                'Besemah' => $kl->kalimat,
                'indonesia' => $kl->arti_kalimat
            ];
        }

        // turunan
        if ($k->turunan->count() > 0) {
            $item['turunan'] = [];
            foreach ($k->turunan as $t) {
                $tItem = [
                    'kata' => $t->kata,
                    'caraBaca' => $t->cara_baca,
                    'jenis' => $this->convertJenis($t->kategori_kata),
                    'arti' => $t->definisi,
                    'status' => $t->status === 'Disetujui' ? 'Valid' : ($t->status === 'Ditolak' ? 'Rejected' : 'Pending'),
                    'contoh' => []
                ];

                foreach ($t->kalimat as $klt) {
                    $tItem['contoh'][] = [
                        'Besemah' => $klt->kalimat,
                        'indonesia' => $klt->arti_kalimat
                    ];
                }

                $item['turunan'][] = $tItem;
            }
        }

        $result[] = $item;
    }

        $role = auth()->user()->role ?? '';
        switch ($role) {
            case 'validator':
                return view('validator.validator-draf', compact('result'));
            case 'kontributor':
                return view('kontributor.status', compact('result'));
            default:
                return view('admin.kelola-kamus', compact('result'));
        }
    }

    
    private function convertJenis($kategori){
        return match ($kategori) {
            'kata_benda'        => 'n',
            'kata_kerja'        => 'v',
            'kata_sifat'        => 'adj',
            'kata_keterangan'   => 'adv',
            'kata_ganti'        => 'pron',
            default             => '',
        };
    }


}
