<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class KataController extends Controller
{
    public function index(){
        // Buat ID otomatis (misal: K0001, K0002, dst.)
        $last = Kata::orderBy('id_kata', 'desc')->first();
        $next = $last ? intval(substr($last->id_kata, 1)) + 1 : 1;
        $autoId = 'K' . str_pad($next, 5, '0', STR_PAD_LEFT);

        // Ambil semua kata utama
        $KataUtama = Kata::select('id_kata', 'kata')->get();

        // Ambil role user
        $role = auth()->user()->role ?? '';

        // Tentukan view berdasarkan role
        switch ($role) {
            case 'validator':
                return view('validator.input-kata', compact('autoId', 'KataUtama'));
            case 'kontributor':
                return view('kontributor.entry-kata', compact('autoId', 'KataUtama'));
            default:
                return view('admin.entry-kata', compact('autoId', 'KataUtama'));
        }
    }
    
    public function tambahKata(Request $request){
        // VALIDASI DATA
        try {
            $validated = $request->validate([
                'id_sub'        => 'nullable|string',
                'jenis_kata'    => 'required|in:utama,turunan',
                'kategori_kata' => 'required|string',
                'kata'          => 'required|string',
                'cara_baca'     => 'nullable|string',
                'definisi'      => 'nullable|string',
                'status'        => 'required|in:Menunggu,Ditolak,Disetujui',
            ]);
        } catch (ValidationException $e) {
            Log::error('Validasi kata gagal:', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan kata: ' . $e->getMessage(),
            ], 422);
        }

        // GENERATE ID KATA OTOMATIS
        $last = Kata::orderBy('id_kata', 'desc')->first();
        $nextNumber = $last ? intval(substr($last->id_kata, 1)) + 1 : 1;
        $newId = 'K' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        $validated['id_kata'] = $newId;

        // SIMPAN DATA
        try {
            Log::info('Data kata tervalidasi, siap disimpan:', $validated);
            Kata::create($validated);
        } catch (\Exception $e) {
            Log::error('Gagal insert kata:', [
                'error' => $e->getMessage(),
                'input' => $validated,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan kata: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kata berhasil disimpan.',
            'data'    => $validated,
        ], 201);
    }

    private function convertJenisToKey($jenisFull){
        return match (strtolower($jenisFull)) {
            'nomina'    => 'kata_benda',
            'verba'     => 'kata_kerja',
            'adjektiva' => 'kata_sifat',
            'adverbia'  => 'kata_keterangan',
            'pronomina' => 'kata_ganti',
            default     => null,
        };
    }
}
