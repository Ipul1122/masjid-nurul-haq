@extends('layouts.dkm')

@section('content')
@section('page-icon', asset('icons/bell-icon.svg'))

<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">📢 Notifikasi Aktivitas</h2>

    <form action="{{ route('dkm.notifikasi.bulkDelete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi yang dipilih?')">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Hapus Terpilih
            </button>
        </div>

        <table class="table-auto w-full border" id="notifikasi-table">
            <thead>
                <tr>
                    <th class="border p-2"><input type="checkbox" id="check-all"></th>
                    <th class="border p-2">Pengguna</th>
                    <th class="border p-2">Aksi</th>
                    <th class="border p-2">Tabel</th>
                    <th class="border p-2">Keterangan</th>
                    <th class="border p-2">Waktu</th>
                    <th class="border p-2">Auto Hapus Dalam</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifikasis as $notif)
                <tr data-id="{{ $notif->id }}" data-created="{{ $notif->created_at }}">
                    <td class="border p-2 text-center">
                        <input type="checkbox" name="ids[]" value="{{ $notif->id }}">
                    </td>
                    <td class="border p-2">{{ $notif->dkm->username ?? 'Tidak diketahui' }}</td>
                    <td class="border p-2">{{ ucfirst($notif->aksi) }}</td>
                    <td class="border p-2">{{ ucfirst($notif->tabel) }}</td>
                    <td class="border p-2">{{ $notif->keterangan }}</td>
                    <td class="border p-2">{{ $notif->created_at->translatedFormat('l, d F Y. H:i') }}</td>
                    <td class="border p-2 countdown">--</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="border p-2 text-center">Belum ada notifikasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>
</div>

<script>
    // Check all
    document.getElementById('check-all')?.addEventListener('change', function(e) {
        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    // Countdown per notifikasi (UI only)
    function updateCountdown() {
        let rows = document.querySelectorAll("#notifikasi-table tbody tr[data-id]");
        let now = new Date().getTime();

        rows.forEach(row => {
            const createdStr = row.dataset.created;
            // convert to JS Date; ensure format is ISO-friendly — Laravel's created_at should work
            let createdAt = new Date(createdStr).getTime();
            // if new Date parse fails (NaN), try replace space with 'T'
            if (isNaN(createdAt)) {
                createdAt = new Date(createdStr.replace(' ', 'T')).getTime();
            }
            let expiredAt = createdAt + (5 * 60 * 1000); // 5 menit
            let diff = expiredAt - now;

            let countdownCell = row.querySelector(".countdown");

            if (!countdownCell) return;

            if (diff <= 0) {
                // visual hapus row dari DOM
                row.remove();
            } else {
                let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((diff % (1000 * 60)) / 1000);
                countdownCell.textContent = `${minutes}m ${seconds}s`;
            }
        });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endsection
