<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk hashing password

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi atribut user dengan data yang sudah divalidasi
        // fill() hanya akan mengisi atribut yang ada di $fillable di model User
        $request->user()->fill($request->validated());

        // Jika email diubah, set email_verified_at menjadi null agar user perlu verifikasi ulang
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle pembaruan password jika ada
        // Periksa apakah bidang 'password' ada dalam request dan tidak kosong
        if ($request->filled('password')) {
            // Hash password baru sebelum disimpan ke database
            $request->user()->password = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        $request->user()->save();

        // Redirect kembali ke halaman edit profil dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}