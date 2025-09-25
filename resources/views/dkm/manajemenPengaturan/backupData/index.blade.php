@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Backup Database</h2>
    <p class="mb-4">Klik tombol di bawah untuk membuat backup database terbaru.</p>

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('dkm.manajemenPengaturan.backupData.run') }}">
        @csrf
        <button type="submit" 
            class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 transition">
            Jalankan Backup
        </button>
    </form>
</div>
@endsection
