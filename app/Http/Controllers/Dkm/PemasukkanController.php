<?php
namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;

class PemasukkanController extends Controller
{
    public function index()
    {
        $pemasukkans = Pemasukkan::latest()->get();
        return view('dkm.manajemenKeuangan.pemasukkan.index', compact('pemasukkans'));
    }

    public function create()
    {
        return view('dkm.manajemenKeuangan.pemasukkan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // hapus semua bukan digit -> menyimpan angka murni
        $total = preg_replace('/[^0-9]/', '', $request->total);

        Pemasukkan::create([
            'total' => $total,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
                         ->with('success', 'Data pemasukkan berhasil ditambahkan.');
    }

    public function edit(Pemasukkan $pemasukkan)
    {
        return view('dkm.manajemenKeuangan.pemasukkan.edit', compact('pemasukkan'));
    }

    public function update(Request $request, Pemasukkan $pemasukkan)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        $pemasukkan->update([
            'total' => $total,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
                         ->with('success', 'Data pemasukkan berhasil diperbarui.');
    }

    public function destroy(Pemasukkan $pemasukkan)
    {
        $pemasukkan->delete();

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
                         ->with('success', 'Data pemasukkan berhasil dihapus.');
    }
}
