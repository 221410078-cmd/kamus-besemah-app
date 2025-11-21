<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;
use App\Models\Kalimat;
use \Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class ValidasiController extends Controller
{
    public function index(){
        $kata = Kata::get()->map(function ($k) {
            return [
                'id' => $k->id_kata,
                'subId' => $k->id_sub ?? '-',
                'tanggal' => $k->created_at ? $k->created_at->format('d/m/Y') : null,
                'konten' => $k->kata,
                'arti' => $k->definisi,
                'cara_baca' => $k->cara_baca,
                'jenis' => $this->convertJenisFull($k->kategori_kata),
                'status' => $k->status,
            ];
        });

        $availableSubIds = $kata->map(function ($k) {
            return "{$k['id']}-{$k['konten']}";
        })->toArray();
        
        $kalimat = Kalimat::all()->map(function ($k) {
            return [
                'id' => $k->id_kalimat,
                'subId' => $k->sub_id ?? '-',
                'tanggal' => $k->created_at ? $k->created_at->format('d/m/Y') : null,
                'konten' => $k->kalimat,
                'cara_baca' => $k->cara_baca ?? null,
                'arti' => $k->arti_kalimat,
                'status' => $k->status,
            ];
        });
        
        $result = [
            'kata' => $kata,
            'kalimat' => $kalimat,
        ];

        $kataValidator = Kata::where('status', 'Menunggu')->get()->map(function ($k) {
            return [
                'id' => $k->id_kata,
                'subId' => $k->id_sub ?? '-',
                'tanggal' => $k->created_at ? $k->created_at->format('d/m/Y') : null,
                'konten' => $k->kata,
                'arti' => $k->definisi,
                'cara_baca' => $k->cara_baca,
                'jenis' => $this->convertJenisFull($k->kategori_kata),
                'status' => $k->status,
            ];
        });


        if (auth()->user()->role === 'validator') {
            return view('validator.validasi-kata', compact('kataValidator', 'availableSubIds'));
        }
        
        return view('admin.admin-validasi', compact('result', 'availableSubIds'));
    }

    public function indexKalimat(){
        $kalimat = Kalimat::where('status', 'Menunggu')->get()->map(function ($k) {
            return [
                'id' => $k->id_kalimat,
                'subId' => $k->sub_id ?? '-',
                'tanggal' => $k->created_at ? $k->created_at->format('d/m/Y') : null,
                'konten' => $k->kalimat,
                'arti' => $k->arti_kalimat,
                'status' => $k->status,
            ];
        });

        $kata = Kata::get()->map(function ($k) {
            return [
                'id' => $k->id_kata,
                'subId' => $k->id_sub ?? '-',
                'tanggal' => $k->created_at ? $k->created_at->format('d/m/Y') : null,
                'konten' => $k->kata,
                'arti' => $k->definisi,
                'cara_baca' => $k->cara_baca,
                'jenis' => $this->convertJenisFull($k->kategori_kata),
                'status' => $k->status,
            ];
        });

        $availableSubIds = $kata->map(function ($k) {
            return "{$k['id']}-{$k['konten']}";
        })->toArray();
        
        return view('validator.validasi-kalimat', compact('kalimat', 'availableSubIds'));
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


    public function updateKata(Request $request){
    try {
        // Validasi input terlebih dahulu
        $validated = $request->validate([
            'kata_id' => 'nullable|string|max:50',
            'sub_id' => 'nullable|string|max:50',
            'jenis' => 'nullable|string|max:50',
            'kata' => 'required|string|max:255',
            'arti' => 'required|string',
            'cara_baca' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);
        \Log::info('Data tervalidasi, siap disimpan:', $validated);
        $kata = Kata::where('id_kata', $validated['kata_id'])->firstOrFail();
        $kata->id_sub = $validated['sub_id'] === '-' ? null : $validated['sub_id'];
        $kata->kategori_kata = $this->convertJenisToKey($validated['jenis']);
        $kata->kata = $validated['kata'];
        $kata->definisi = $validated['arti'];
        $kata->cara_baca = $validated['cara_baca'] ?? null;
        $kata->status = $validated['status'];
       
        // Update tanggal validasi jika status berubah
        if ($validated['status'] !== 'Menunggu') {
            $kata->updated_at = now();
        }

        $kata->save();

        return response()->json([
            'success' => true,
            'message' => 'Kata berhasil diperbarui.',
            'data' => $kata,
        ], 200);

    } catch (ModelNotFoundException $e) {
        \Log::info('Validasi gagal:', $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => `Kata tidak ditemukan.`,
        ], 404);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal.',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Exception $e) {
        \Log::error('Terjadi kesalahan update kata:', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui kata.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    public function updateKalimat(Request $request){
      try {
        // Validasi input
        $validated = $request->validate([
            'kalimat_id' => 'nullable|string|max:50',
            'sub_id' => 'nullable|string|max:50',
            'kalimat' => 'required|string',
            'arti' => 'required|string',
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);
        \Log::info('Data tervalidasi, siap disimpan:', $validated);
        $kalimat = Kalimat::where('id_kalimat', $validated['kalimat_id'])->firstOrFail();
        $kalimat->sub_id = $validated['sub_id'] === '-' ? null : $validated['sub_id'];
        $kalimat->kalimat = $validated['kalimat'];
        $kalimat->arti_kalimat = $validated['arti'];
        $kalimat->status = $validated['status'];

        if ($validated['status'] !== 'Menunggu') {
            $kalimat->updated_at = now();
        }

        $kalimat->save();

        return response()->json([
            'success' => true,
            'message' => 'Kalimat berhasil diperbarui.',
            'data' => $kalimat,
        ], 200);

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Kalimat tidak ditemukan.',
        ], 404);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal.',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui kalimat.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function deleteKata(Request $request){
      try {
        $id = $request->id;

        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'ID kata tidak ditemukan dalam request.',
            ], 400);
        }

        $kata = Kata::where('id_kata', $id)->firstOrFail();
        $kata->delete();

        return response()->json([
            'success' => true,
            'message' => "Kata dengan ID {$id} berhasil dihapus.",
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menghapus kata.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function deleteKalimat(Request $request){
      try {
        $id = $request->id;

        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'ID kalimat tidak ditemukan dalam request.',
            ], 400);
        }

        $kalimat = Kalimat::where('id_kalimat', $id)->firstOrFail();
        $kalimat->delete();

        return response()->json([
            'success' => true,
            'message' => "Kalimat dengan ID {$id} berhasil dihapus.",
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menghapus kalimat.',
            'error' => $e->getMessage(),
        ], 500);
     }
    }

    public function updateStatus(Request $request){
     try {
        // Validasi minimal salah satu ID harus ada
        $validated = $request->validate([
            'id_kata' => 'nullable|string',
            'id_kalimat' => 'nullable|string',
            'status' => 'required|in:menunggu,ditolak,disetujui',
        ]);

        if (!$validated['id_kata'] && !$validated['id_kalimat']) {
            return response()->json([
                'success' => false,
                'message' => 'Harus menyertakan id_kata atau id_kalimat.',
            ], 400);
        }

        // Tentukan model berdasarkan input yang dikirim
        if ($validated['id_kata']) {
            $item = Kata::where('id_kata', $validated['id_kata'])->firstOrFail();
        } else {
            $item = Kalimat::where('id_kalimat', $validated['id_kalimat'])->firstOrFail();
        }

        // Update status
        $item->status = $validated['status'];
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.',
            'data' => $item,
        ], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.',
        ], 404);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Validasi gagal:', [
            'errors' => $e->errors(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan server.',
            'error' => $e->getMessage(),
        ], 500);
    }
 }


    

}
