<?php
namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use App\Models\KategoriPemasukkan;


class PemasukkanController extends Controller
{
    public function index()
    {
        $pemasukkans = Pemasukkan::with('kategori')->get();
        return view('dkm.manajemenKeuangan.pemasukkan.index', compact('pemasukkans'));
    }

   public function create()
    {
        $kategori = KategoriPemasukkan::all();
        return view('dkm.manajemenKeuangan.pemasukkan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pemasukkans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        Pemasukkan::create([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);


        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
                         ->with('success', 'Data pemasukkan berhasil ditambahkan.');
    }

    public function edit(Pemasukkan $pemasukkan)
    {
        $kategori = KategoriPemasukkan::all();
        return view('dkm.manajemenKeuangan.pemasukkan.edit', compact('pemasukkan','kategori'));
    }


    public function update(Request $request, Pemasukkan $pemasukkan)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pemasukkans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        $pemasukkan->update([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
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
