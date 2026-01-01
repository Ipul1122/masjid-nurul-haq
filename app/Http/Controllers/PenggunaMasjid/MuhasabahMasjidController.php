<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MuhasabahSoal;
use App\Models\MuhasabahAnggota;

class MuhasabahMasjidController extends Controller
{
    // 1. Halaman Login
    public function formLogin()
    {
        // Jika sudah login, langsung lempar ke dashboard
        if (Auth::guard('muhasabah_group')->check() || Auth::guard('muhasabah_anggota')->check()) {
            return redirect()->route('muhasabah.dashboard');
        }
        return view('penggunaMasjid.login');
    }

    // 2. Proses Login
    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required|in:group,anggota', // Pilihan login sebagai apa
        ]);

        $credentials = $request->only('username', 'password');

        if ($request->role == 'group') {
            if (Auth::guard('muhasabah_group')->attempt($credentials)) {
                return redirect()->route('muhasabah.dashboard');
            }
        } else {
            if (Auth::guard('muhasabah_anggota')->attempt($credentials)) {
                return redirect()->route('muhasabah.dashboard');
            }
        }

        return back()->with('error', 'Username atau Password salah, atau Role tidak sesuai.');
    }

    // 3. Logout
    public function logout()
    {
        if (Auth::guard('muhasabah_group')->check()) {
            Auth::guard('muhasabah_group')->logout();
        } elseif (Auth::guard('muhasabah_anggota')->check()) {
            Auth::guard('muhasabah_anggota')->logout();
        }
        return redirect()->route('muhasabah.login');
    }

    // 4. Dashboard (Smart Logic)
    public function dashboard()
    {
        // Cek siapa yang login
        if (Auth::guard('muhasabah_group')->check()) {
            // A. LOGIC UNTUK GROUP (Ketua)
            $group = Auth::guard('muhasabah_group')->user();
            $anggotas = MuhasabahAnggota::where('group_id', $group->id)->get();
            
            return view('penggunaMasjid.dashboard', [
                'role' => 'group',
                'user' => $group,
                'data' => $anggotas // Kirim data anggota ke view
            ]);

        } elseif (Auth::guard('muhasabah_anggota')->check()) {
            // B. LOGIC UNTUK ANGGOTA (Jemaah)
            $anggota = Auth::guard('muhasabah_anggota')->user();
            // Ambil soal-soal aktif untuk ditampilkan di form
            $soals = MuhasabahSoal::where('is_active', true)->orderBy('urutan')->get();

            return view('penggunaMasjid.dashboard', [
                'role' => 'anggota',
                'user' => $anggota,
                'soals' => $soals // Kirim soal ke view
            ]);

        } else {
            return redirect()->route('muhasabah.login');
        }
    }
}