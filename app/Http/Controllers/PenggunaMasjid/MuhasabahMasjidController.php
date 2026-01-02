<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MuhasabahSoal;
use App\Models\MuhasabahAnggota;
use App\Models\LaporanMuhasabahAnggota; 
use Carbon\Carbon;

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

    public function dashboard(Request $request)
    {
        // 1. Cek Login
        if (!Auth::guard('muhasabah_anggota')->check() && !Auth::guard('dkm')->check()) {
            return redirect()->route('muhasabah.login');
        }

        $user = null;
        $role = null;
        $temanSeGroup = collect();
        
        // Default tanggal lihat adalah hari ini, atau diambil dari request user
        $tanggalLihat = $request->input('tanggal_lihat', now()->format('Y-m-d'));

        if (Auth::guard('muhasabah_anggota')->check()) {
            $user = Auth::guard('muhasabah_anggota')->user();
            $role = $user->role ?? 'anggota'; 

            if ($user->group_id) {
                // Ambil teman se-group
                $temanSeGroup = MuhasabahAnggota::where('group_id', $user->group_id)
                                ->orderBy('nama_lengkap', 'asc')
                                ->get()
                                ->map(function ($teman) use ($tanggalLihat) {
                                    // LOGIKA BARU: Cek apakah teman ini sudah lapor di tanggal tersebut?
                                    $cek = LaporanMuhasabahAnggota::where('anggota_id', $teman->id)
                                            ->where('tanggal', $tanggalLihat)
                                            ->exists();
                                    
                                    // Tambahkan properti baru ke object teman secara on-the-fly
                                    $teman->sudah_lapor = $cek;
                                    return $teman;
                                });
            }
        } else {
            $user = Auth::guard('dkm')->user();
        }

        $soals = MuhasabahSoal::where('is_active', 1)
                    ->orderBy('urutan', 'asc')
                    ->get();

        // Kirim $tanggalLihat ke view
        return view('penggunaMasjid.dashboard', compact('user', 'role', 'soals', 'temanSeGroup', 'tanggalLihat'));
    }

    // METHOD STORE (PENYIMPANAN)
    public function store(Request $request)
    {
        // 1. Validasi: Tanggal harus diisi dan tidak boleh lebih dari hari ini (besok)
        $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'jawaban' => 'required|array',
        ], [
            'tanggal.required' => 'Tanggal laporan wajib diisi.',
            'tanggal.before_or_equal' => 'Anda tidak dapat mengisi laporan untuk hari esok.',
        ]);

        if (!Auth::guard('muhasabah_anggota')->check()) {
            return redirect()->route('muhasabah.login')->with('error', 'Sesi habis, silakan login kembali.');
        }

        $anggota = Auth::guard('muhasabah_anggota')->user();
        
        $tanggalLaporan = $request->tanggal; 

       

        $inputs = $request->input('jawaban');

        if ($inputs) {
            foreach ($inputs as $soal_id => $jawaban) {
                // Handle checkbox (array to string)
                if (is_array($jawaban)) {
                    $jawaban = implode(', ', $jawaban);
                }

                LaporanMuhasabahAnggota::create([
                    'anggota_id'       => $anggota->id,
                    'muhasabah_soal_id' => $soal_id,
                    'jawaban'          => $jawaban,
                    'tanggal'          => $tanggalLaporan, // Gunakan variabel dari request user
                ]);
            }
        }

        // Format tanggal untuk pesan notifikasi (Indonesia)
        $tglIndo = Carbon::parse($tanggalLaporan)->locale('id')->translatedFormat('l, d F Y');

        return redirect()->route('muhasabah.dashboard')
            ->with('success', "Alhamdulillah, laporan muhasabah untuk tanggal $tglIndo berhasil dikirim.");
    }
}