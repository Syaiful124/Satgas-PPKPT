<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->pengaduans()->with('kategori')->latest();

        // Fitur Search untuk laporan user
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter untuk laporan user
        if ($request->filled('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        // ... filter lainnya bisa ditambahkan ...

        $pengaduans = $query->paginate(5);

        return view('user.account', compact('user', 'pengaduans'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        // Jika user mengganti password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        // Langsung update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('account.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
