@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">📢 Notifikasi Aktivitas</h2>
    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border p-2">Pengguna</th>
                <th class="border p-2">Aksi</th>
                <th class="border p-2">Tabel</th>
                <th class="border p-2">Keterangan</th>
                <th class="border p-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifikasis as $notif)
            <tr>
                <td class="border p-2">{{ $notif->dkm->username ?? 'Tidak diketahui' }}</td>
                <td class="border p-2">{{ ucfirst($notif->aksi) }}</td>
                <td class="border p-2">{{ ucfirst($notif->tabel) }}</td>
                <td class="border p-2">{{ $notif->keterangan }}</td>
                <td class="border p-2">{{ $notif->created_at->translatedFormat('l, d F Y. H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
