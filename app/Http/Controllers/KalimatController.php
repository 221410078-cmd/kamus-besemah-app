<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalimat;
use App\Models\Kata;
use Illuminate\Validation\ValidationException;

class KalimatController extends Controller
{
    public function index(){
        // Ambil ID terakhir dari tabel kalimat
        $lastKalimat = Kalimat::orderBy('id_kalimat', 'DESC')->first();
        $nextNumber  = $lastKalimat ? intval(substr($lastKalimat->id_kalimat, 1)) + 1 : 1;
        $autoId      = 'KL' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Ambil semua data kata beserta relasi kalimatnya
        $kata = Kata::with('kalimat')->get();

        // Tampilkan view berdasarkan role user
        $role = auth()->user()->role ?? '';
        switch ($role) {
            case 'validator':
                return view('validator.input-kalimat', compact('autoId', 'kata'));
            case 'kontributor':
                return view('kontributor.entry-kalimat', compact('autoId', 'kata'));
            default:
                return view('admin.entry-kalimat', compact('autoId', 'kata'));
        }
    }

    public function tambahKalimat(Request $request){
        // Validasi input
        try {
            $validated = $request->validate([
                'sub_id'        => 'required|string|exists:kata,id_kata',
                'kalimat'       => 'required|string',
                'arti_kalimat'  => 'nullable|string',
                'status'        => 'required|in:Menunggu,Ditolak,Disetujui',
            ]);
        } catch (ValidationException $e) {
            \Log::error('Validasi kalimat gagal:', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Periksa input Anda.',
                'errors'  => $e->errors(),
            ], 422);
        }

        // Generate ID kalimat baru
        $lastKalimat = Kalimat::orderBy('id_kalimat', 'DESC')->first();
        $nextNumber  = $lastKalimat ? intval(substr($lastKalimat->id_kalimat, 1)) + 1 : 1;
        $newId       = 'KL' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        $validated['id_kalimat'] = $newId;

        // Simpan ke database
        try {
            \Log::info('Data kalimat tervalidasi, siap disimpan:', $validated);

            Kalimat::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kalimat berhasil disimpan.',
                'id_kalimat' => $newId,
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Gagal insert kalimat:', [
                'error' => $e->getMessage(),
                'input' => $validated,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan kalimat.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
