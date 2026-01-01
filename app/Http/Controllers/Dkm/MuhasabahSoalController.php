<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\MuhasabahSoal;
use Illuminate\Http\Request;

class MuhasabahSoalController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan kolom urutan ASC
        $soals = MuhasabahSoal::orderBy('urutan', 'asc')->get();
        return view('dkm.muhasabah.isiMuhasabah.index', compact('soals'));
    }

    public function create()
    {

        $maxUrutan = MuhasabahSoal::max('urutan');
        $nextUrutan = $maxUrutan ? $maxUrutan + 1 : 1;

        return view('dkm.muhasabah.isiMuhasabah.create', compact('nextUrutan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tipe_soal' => 'required|in:short_text,paragraph,radio,checkbox',
            'urutan' => 'required|integer',
        ]);

        $data = [
            'pertanyaan' => $request->pertanyaan,
            'deskripsi' => $request->deskripsi,
            'tipe_soal' => $request->tipe_soal,
            'urutan' => $request->urutan,
            'is_active' => $request->has('is_active') ? true : false,
            'is_required' => $request->has('is_required') ? true : false,
        ];

        // Jika tipe soal pilihan ganda, ambil input opsinya
        if (in_array($request->tipe_soal, ['radio', 'checkbox'])) {
            // Filter array agar opsi yang kosong tidak ikut tersimpan
            $opsi = array_filter($request->input('opsi', []), function($value) { 
                return !is_null($value) && $value !== ''; 
            });
            // Re-index array supaya rapi (0, 1, 2)
            $data['opsi_jawaban'] = array_values($opsi);
        } else {
            $data['opsi_jawaban'] = null;
        }

        MuhasabahSoal::create($data);

        return redirect()->route('dkm.muhasabah.soal.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $soal = MuhasabahSoal::findOrFail($id);
        return view('dkm.muhasabah.isiMuhasabah.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $soal = MuhasabahSoal::findOrFail($id);

        $request->validate([
            'pertanyaan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tipe_soal' => 'required|in:short_text,paragraph,radio,checkbox',
            'urutan' => 'required|integer',
        ]);

        $data = [
            'pertanyaan' => $request->pertanyaan,
            'deskripsi' => $request->deskripsi,
            'tipe_soal' => $request->tipe_soal,
            'urutan' => $request->urutan,
            'is_active' => $request->has('is_active') ? true : false,
            'is_required' => $request->has('is_required') ? true : false,
        ];

        if (in_array($request->tipe_soal, ['radio', 'checkbox'])) {
            $opsi = array_filter($request->input('opsi', []), function($value) { 
                return !is_null($value) && $value !== ''; 
            });
            $data['opsi_jawaban'] = array_values($opsi);
        } else {
            $data['opsi_jawaban'] = null;
        }

        $soal->update($data);

        return redirect()->route('dkm.muhasabah.soal.index')->with('success', 'Pertanyaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $soal = MuhasabahSoal::findOrFail($id);
        $soal->delete();

        $semuaSoal = MuhasabahSoal::orderBy('urutan', 'asc')->get();

        foreach ($semuaSoal as $index => $item) {
            $item->update(['urutan' => $index + 1]);
        }

        return redirect()->route('dkm.muhasabah.soal.index')->with('success', 'Pertanyaan dihapus');
    }
}