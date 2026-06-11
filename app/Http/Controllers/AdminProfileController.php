<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function show()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_hp' => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        $data = [
            'no_hp' => $request->no_hp,
        ];

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $data['foto_profil'] = $request->file('foto_profil')->store('profile', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }
}
