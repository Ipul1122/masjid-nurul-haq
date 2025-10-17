<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarahs = Sejarah::all();
        return view('dkm.tampilanPenggunaMasjid.sejarah.index', compact('sejarahs'));
    }

    public function create()
    {
        return view('dkm.tampilanPenggunaMasjid.sejarah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Sejarah::create($request->all());

        return redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index')
                        ->with('success','Sejarah created successfully.');
    }

    public function edit(Sejarah $sejarah)
    {
        return view('dkm.tampilanPenggunaMasjid.sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $sejarah->update($request->all());

        return redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index')
                        ->with('success','Sejarah updated successfully');
    }

    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();

        return redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index')
                        ->with('success','Sejarah deleted successfully');
    }
}