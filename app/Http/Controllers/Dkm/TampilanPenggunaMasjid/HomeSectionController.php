<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\TampilanPenggunaMasjid\RunningText;
use App\Models\Notifikasi; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HomeSectionController extends Controller
{
    public function index()
    {
        $images = HomeSection::all();
        return view('dkm.TampilanPenggunaMasjid.homeSection', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'carousel_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $image) {
                $path = $image->store('carousel', 'public');
                HomeSection::create(['image_path' => $path]);
            }

            // <-- TAMBAHKAN NOTIFIKASI DI SINI
            Notifikasi::create([
                'dkm_id' => session('dkm_id'),
                'aksi' => 'create',
                'tabel' => 'home_section', // Sesuaikan dengan tabel Anda
                'keterangan' => 'Menambah gambar carousel baru',
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(HomeSection $homeSection)
    {
        Storage::disk('public')->delete($homeSection->image_path);
        $homeSection->delete();

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'home_section', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Menghapus gambar carousel: ' . $homeSection->image_path,
        ]);

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    // --- Fungsi Baru Untuk Running Text ---

    /**
     * Menampilkan halaman untuk mengatur running text.
     */
    public function runningText()
    {
        $runningText = RunningText::first(); // Ambil teks yang ada
        return view('dkm.TampilanPenggunaMasjid.runningText', compact('runningText'));
    }

    public function storeRunningText(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:10000',
        ]);

        $cleanContent = $this->sanitizeRunningTextHtml($request->input('content'));

        $runningText = RunningText::updateOrCreate(
            ['id' => 1],
            ['content' => $cleanContent]
        );

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'running_text', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Memperbarui running text: ' . strip_tags($cleanContent),
        ]);

        return redirect()->back()->with('success', 'Running text berhasil diperbarui.');
    }

    /**
     * Menyimpan atau memperbarui running text.
     */
    public function runningTextUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'text_color' => 'required|string',
            'background_color' => 'required|string',
        ]);

        RunningText::updateOrCreate(
            ['id' => 1],
            [
                // Menggunakan metode input() untuk menghindari peringatan
                'content' => $request->input('content'),
                'text_color' => $request->input('text_color'),
                'background_color' => $request->input('background_color'),
            ]
        );

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'running_text', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Memperbarui running text (dengan warna): ' . $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Running text berhasil diperbarui.');
    }
    /**
     * Sanitasi HTML dari rich editor — hanya izinkan tag yang aman.
     * Mencegah XSS tanpa membutuhkan library eksternal.
     */
    private function sanitizeRunningTextHtml(string $html): string
    {
        // Tag dan atribut yang diizinkan
        $allowedTags = '<b><strong><i><em><span><a><br>';
        $stripped    = strip_tags($html, $allowedTags);

        // Hapus atribut berbahaya (on*, javascript:, dll.) menggunakan regex
        $stripped = preg_replace('/\bon\w+\s*=\s*["\'][^"\']*["\']/i', '', $stripped);
        $stripped = preg_replace('/javascript\s*:/i', '', $stripped);

        // Izinkan hanya atribut aman: style, href, target, rel, color
        $stripped = preg_replace_callback(
            '/<(b|strong|i|em|span|a|br)(\s[^>]*)?>/',
            function ($matches) {
                $tag   = $matches[1];
                $attrs = isset($matches[2]) ? $matches[2] : '';

                $safeAttrs = '';

                // style="..." — izinkan
                if (preg_match('/style\s*=\s*"([^"]*)"/i', $attrs, $m)) {
                    // Hapus expression/url berbahaya dalam style
                    $style = preg_replace('/(expression|javascript|vbscript|url)\s*\(/i', '', $m[1]);
                    $safeAttrs .= ' style="' . htmlspecialchars($style, ENT_QUOTES) . '"';
                }

                // href="..." — hanya untuk <a>, hanya http/https
                if ($tag === 'a' && preg_match('/href\s*=\s*"([^"]*)"/i', $attrs, $m)) {
                    $href = trim($m[1]);
                    if (preg_match('/^https?:\/\//i', $href)) {
                        $safeAttrs .= ' href="' . htmlspecialchars($href, ENT_QUOTES) . '"';
                        $safeAttrs .= ' target="_blank" rel="noopener noreferrer"';
                    }
                }

                // color="..." — legacy attribute
                if (preg_match('/color\s*=\s*"([^"]*)"/i', $attrs, $m)) {
                    $safeAttrs .= ' color="' . htmlspecialchars($m[1], ENT_QUOTES) . '"';
                }

                return '<' . $tag . $safeAttrs . '>';
            },
            $stripped
        );

        return trim($stripped);
    }
}