@extends('layouts.dkm')

@section('title', 'Notifikasi')
@section('page-icon', asset('icons/bell-icon.svg'))

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            {{-- ✅ PERUBAHAN: Tag <form> dipindahkan ke sini --}}
            <form action="{{ route('dkm.notifikasi.bulkDelete') }}" method="POST" id="bulk-delete-form" onsubmit="return confirm('Yakin ingin menghapus notifikasi yang dipilih?')">
                @csrf
                @method('DELETE')

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div class="flex items-center mb-4 md:mb-0">
                        <img src="@yield('page-icon')" class="h-8 w-8 mr-3" alt="Notifikasi Icon">
                        <h2 class="text-2xl font-bold text-gray-800">Notifikasi</h2>
                    </div>
                    {{-- Tombol submit sekarang ada di dalam form --}}
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out flex items-center disabled:opacity-50 disabled:cursor-not-allowed" id="bulk-delete-button" disabled> {{-- Tambahkan ID dan disabled default --}}
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus Terpilih
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-t border-b border-gray-200" id="notifikasi-table">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="p-3 text-left w-12"><input type="checkbox" id="check-all" class="form-checkbox h-5 w-5 text-blue-600 rounded"></th> {{-- Tambah rounded --}}
                                <th class="p-3 text-left font-semibold">Pengguna</th>
                                <th class="p-3 text-left font-semibold">Aksi</th>
                                <th class="p-3 text-left font-semibold">Tabel</th>
                                <th class="p-3 text-left font-semibold">Keterangan</th>
                                <th class="p-3 text-left font-semibold">Waktu</th>
                                <th class="p-3 text-left font-semibold">Auto Hapus Dalam</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse ($notifikasis as $notif)
                            <tr data-id="{{ $notif->id }}" data-created="{{ $notif->created_at }}" class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="p-3 text-center">
                                    {{-- Checkbox sekarang ada di dalam form --}}
                                    <input type="checkbox" name="ids[]" value="{{ $notif->id }}" class="form-checkbox h-5 w-5 text-blue-600 rounded notif-checkbox"> {{-- Tambah rounded & class --}}
                                </td>
                                <td class="p-3">{{ $notif->dkm->username ?? 'Tidak diketahui' }}</td>
                                <td class="p-3">{{ ucfirst($notif->aksi) }}</td>
                                <td class="p-3">{{ ucfirst($notif->tabel) }}</td>
                                <td class="p-3">{{ $notif->keterangan }}</td>
                                <td class="p-3">{{ $notif->created_at->translatedFormat('l, d F Y. H:i') }}</td>
                                <td class="p-3 countdown font-mono text-sm">--</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-3 text-center text-gray-500">Belum ada notifikasi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            {{-- ✅ PERUBAHAN: Tag </form> dipindahkan ke sini --}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('check-all');
        const checkboxes = document.querySelectorAll('.notif-checkbox'); // Gunakan class selector
        const bulkDeleteButton = document.getElementById('bulk-delete-button'); // Ambil tombol

        // Fungsi untuk mengecek status tombol Hapus
        function checkButtonStatus() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            bulkDeleteButton.disabled = !anyChecked;
        }

        // Event listener untuk checkAll
        if (checkAll) {
            checkAll.addEventListener('change', function(e) {
                checkboxes.forEach(cb => cb.checked = e.target.checked);
                checkButtonStatus(); // Update status tombol
            });
        }

        // Event listener untuk setiap checkbox individual
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                // Jika ada checkbox yang tidak tercentang, uncheck checkAll
                if (!this.checked) {
                    checkAll.checked = false;
                } 
                // Jika semua checkbox tercentang, check checkAll
                else if (Array.from(checkboxes).every(c => c.checked)) {
                    checkAll.checked = true;
                }
                checkButtonStatus(); // Update status tombol
            });
        });

        // Countdown (Kode tetap sama)
        function updateCountdown() {
            const rows = document.querySelectorAll("#notifikasi-table tbody tr[data-id]");
            const now = new Date().getTime();

            rows.forEach(row => {
                const createdStr = row.dataset.created;
                // Penyesuaian parsing tanggal jika diperlukan, format 'Y-m-d H:i:s' umumnya aman
                const createdAt = new Date(createdStr.replace(' ', 'T')).getTime(); 
                const expiredAt = createdAt + (5 * 60 * 1000); // 5 menit
                const diff = expiredAt - now;

                const countdownCell = row.querySelector(".countdown");
                if (!countdownCell) return;

                if (diff <= 0) {
                    countdownCell.textContent = "Expired";
                    countdownCell.classList.add('text-red-500', 'font-semibold');
                    // Jika ingin menghapus baris dari DOM saat expired di client side (opsional):
                    // row.remove(); 
                } else {
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    countdownCell.textContent = `${minutes}m ${seconds}s`;
                    countdownCell.classList.remove('text-red-500', 'font-semibold');
                }
            });
        }

        setInterval(updateCountdown, 1000);
        updateCountdown(); // Panggil sekali saat load
        checkButtonStatus(); // Panggil sekali saat load untuk inisialisasi status tombol
    });
</script>
@endsection
