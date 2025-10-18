@extends('layouts.dkm')

@section('title', 'Notifikasi')
@section('page-icon', asset('icons/bell-icon.svg'))

@section('content')
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
@endsection

{{-- PERBAIKAN: Skrip ditempatkan di dalam section 'scripts' --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Fungsi untuk checkbox "Pilih Semua"
        const checkAll = document.getElementById('check-all');
        if (checkAll) {
            checkAll.addEventListener('change', function(e) {
                let checkboxes = document.querySelectorAll('input[name="ids[]"]');
                checkboxes.forEach(cb => cb.checked = e.target.checked);
            });
        }

        // 2. Fungsi untuk countdown visual di setiap baris
        function updateCountdown() {
            const rows = document.querySelectorAll("#notifikasi-table tbody tr[data-id]");
            const now = new Date().getTime();

            rows.forEach(row => {
                const createdStr = row.dataset.created;
                // Mengganti spasi dengan 'T' untuk kompatibilitas parsing tanggal di semua browser
                const createdAt = new Date(createdStr.replace(' ', 'T')).getTime();
                
                // Tambah 5 menit (dalam milidetik)
                const expiredAt = createdAt + (5 * 60 * 1000); 
                const diff = expiredAt - now;

                const countdownCell = row.querySelector(".countdown");
                if (!countdownCell) return;

                if (diff <= 0) {
                    // Cukup tampilkan "Expired". 
                    // Skrip global di layout akan menghapus baris ini dari DOM.
                    countdownCell.textContent = "Expired"; 
                } else {
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    countdownCell.textContent = `${minutes}m ${seconds}s`;
                }
            });
        }

        // Jalankan countdown setiap detik
        setInterval(updateCountdown, 1000);

        // Panggil sekali saat halaman dimuat untuk tampilan awal
        updateCountdown();
    });
</script>
@endsection