<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MuhasabahSoal;
use App\Models\MuhasabahAnggota;
use App\Models\LaporanMuhasabahAnggota; // Pastikan model ini ada

class MuhasabahMasjidController extends Controller
{
    // ... method formLogin, processLogin, logout, dashboard (seperti sebelumnya) ...

    public function formLogin()
    {
        if (Auth::guard('muhasabah_group')->check() || Auth::guard('muhasabah_anggota')->check()) {
            return redirect()->route('muhasabah.dashboard');
        }
        return view('penggunaMasjid.login'); // Ganti view jika perlu
        // Atau: return view('risnha.login'); tergantung struktur Anda
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required|in:group,anggota',
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

        return back()->with('error', 'Login Gagal. Cek username/password.');
    }

    public function logout()
    {
        if (Auth::guard('muhasabah_group')->check()) Auth::guard('muhasabah_group')->logout();
        if (Auth::guard('muhasabah_anggota')->check()) Auth::guard('muhasabah_anggota')->logout();
        return redirect()->route('muhasabah.login');
    }

    public function dashboard()
    {
        if (Auth::guard('muhasabah_group')->check()) {
            $group = Auth::guard('muhasabah_group')->user();
            $anggotas = MuhasabahAnggota::where('group_id', $group->id)->get();
            return view('penggunaMasjid.dashboard', ['role' => 'group', 'user' => $group, 'data' => $anggotas]);
        } elseif (Auth::guard('muhasabah_anggota')->check()) {
            $anggota = Auth::guard('muhasabah_anggota')->user();
            $soals = MuhasabahSoal::where('is_active', true)->orderBy('urutan')->get();
            return view('penggunaMasjid.dashboard', ['role' => 'anggota', 'user' => $anggota, 'soals' => $soals]);
        }
        return redirect()->route('muhasabah.login');
    }

    // METHOD STORE (PENYIMPANAN)
    public function store(Request $request)
    {
        // 1. Validasi User
        if (!Auth::guard('muhasabah_anggota')->check()) {
            return redirect()->route('muhasabah.login')->with('error', 'Sesi habis.');
        }

        $anggota = Auth::guard('muhasabah_anggota')->user();
        $inputs = $request->input('jawaban'); // Array jawaban dari form

        if ($inputs) {
            foreach ($inputs as $soal_id => $jawaban) {
                // Handle Checkbox (Array to String)
                if (is_array($jawaban)) {
                    $jawaban = implode(', ', $jawaban);
                }

                // Simpan ke Database
                LaporanMuhasabahAnggota::create([
                    'anggota_id' => $anggota->id,
                    'muhasabah_soal_id' => $soal_id,
                    'jawaban' => $jawaban,
                    'tanggal' => now()->toDateString(),
                ]);
            }
        }

        return redirect()->route('muhasabah.dashboard')->with('success', 'Laporan Muhasabah Berhasil Dikirim!');
    }
}