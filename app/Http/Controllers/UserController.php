<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
   
    public function index(){
        $users = User::orderBy('created_at', 'asc')->get();
        return view('admin.kelola-user', compact('users'));
    }

    public function tambahUser(Request $request){
        // VALIDASI
        try {
            $validated = $request->validate([
                'username' => 'required|unique:users,username',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role'     => 'required|in:admin,validator,kontributor',
                'status'   => 'required|in:aktif,nonaktif,active,inactive',
            ]);
        } catch (ValidationException $e) {
            \Log::error('Validasi gagal:', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 442);
        }

        // SIMPAN KE DATABASE
        try {
            $validated['password'] = Hash::make($validated['password']);
            \Log::info('Data tervalidasi, siap disimpan:', $validated);

            $user = User::create($validated);

            return response()->json([
                'success' => true,
                'data'    => $user,
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal insert user:', [
                'error' => $e->getMessage(),
                'input' => $validated,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateUser(Request $request, User $user){
        // VALIDASI
        try {
            $validated = $request->validate([
                'username' => 'required|unique:users,username,' . $user->id,
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'role'     => 'required|in:admin,validator,kontributor',
            ]);

            \Log::info('UPDATE: validasi sukses', $validated);
        } catch (ValidationException $e) {
            \Log::error('UPDATE: validasi gagal', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 442);
        }

        // PASSWORD BARU (jika diisi)
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        // UPDATE DATABASE
        try {
            $user->update($validated);
            \Log::info('UPDATE: user berhasil diperbarui di DB', $validated);

            return response()->json([
                'success' => true,
                'data'    => $user,
            ]);
        } catch (\Exception $e) {
            \Log::error('UPDATE: gagal update user', [
                'error'     => $e->getMessage(),
                'validated' => $validated,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function hapusUser(User $user){
        try {
            $username = $user->username;
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => "Pengguna {$username} berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal menghapus pengguna:', [
                'error' => $e->getMessage(),
                'user'  => $user,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pengguna: ' . $e->getMessage(),
            ], 500);
        }
    }
}
