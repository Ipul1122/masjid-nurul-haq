<!-- Mobile Navbar -->
<header class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-white shadow-md h-14">
    <div class="flex items-center justify-between px-4 py-3">
        <button id="sidebarToggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="font-bold text-lg text-gray-900">Masjid Nurul Haq</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                <i class="fas fa-bell text-lg"></i>
                <!-- badge selalu ada, toggle class 'hidden' bila count == 0 -->
                <span
                    class="notif-badge absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ ($notifCount ?? 0) > 0 ? '' : 'hidden' }}"
                >
                    {{ ($notifCount ?? 0) > 9 ? '9+' : ($notifCount ?? 0) }}
                </span>
            </a>
        </div>
    </div>
</header>

<!-- Desktop Navbar -->
<header class="hidden lg:block fixed top-0 left-0 right-0 z-30 bg-white shadow-sm border-b border-gray-200 h-20">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600">Selamat datang di panel administrasi</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-3 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">
                <i class="fas fa-bell text-lg"></i>
                <span
                    class="notif-badge absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ ($notifCount ?? 0) > 0 ? '' : 'hidden' }}"
                >
                    {{ ($notifCount ?? 0) > 9 ? '9+' : ($notifCount ?? 0) }}
                </span>
            </a>
            <div class="flex items-center space-x-3 px-3 py-2 bg-gray-50 rounded-xl">
                <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="text-sm">
                    <p class="font-medium text-gray-900">Admin</p>
                    <p class="text-gray-600">Online</p>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Global JS: sync badge + auto-delete --}}
<script>
(function(){
    // jangan jalankan dua kali jika script disertakan berulang
    if (window.__notif_sync_started) return;
    window.__notif_sync_started = true;

    const autoDeleteUrl = "{{ route('dkm.notifikasi.autoDeleteOld') }}";
    const countUrl = "{{ route('dkm.notifikasi.count') }}";
    const csrfToken = "{{ csrf_token() }}";

    // update tampilan badge
    function updateBadge(count) {
        const badges = document.querySelectorAll('.notif-badge');
        badges.forEach(b => {
            if (count > 0) {
                b.textContent = count > 9 ? '9+' : String(count);
                b.classList.remove('hidden');
            } else {
                b.classList.add('hidden');
            }
        });
    }

    // hapus row di DOM berdasarkan id
    function removeRowsFromDOM(ids) {
        if (!Array.isArray(ids) || ids.length === 0) return;
        ids.forEach(id => {
            const row = document.querySelector(`#notifikasi-table tbody tr[data-id="${id}"]`);
            if (row) row.remove();
        });

        // jika tbody kosong, tampilkan placeholder row
        const tbody = document.querySelector('#notifikasi-table tbody');
        if (tbody && tbody.children.length === 0) {
            const placeholder = document.createElement('tr');
            placeholder.innerHTML = `<td colspan="7" class="border p-2 text-center">Belum ada notifikasi</td>`;
            tbody.appendChild(placeholder);
        }
    }

    // panggil endpoint auto-delete dan sinkronkan DOM + badge
    async function autoDeleteAndSync() {
        try {
            const res = await fetch(autoDeleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            if (!res.ok) return;
            const data = await res.json();
            if (data && data.status === 'success') {
                if (data.deleted_ids && data.deleted_ids.length) {
                    removeRowsFromDOM(data.deleted_ids);
                }
                if (typeof data.count !== 'undefined') {
                    updateBadge(data.count);
                } else {
                    // fallback: ambil count via count endpoint
                    refreshNotifCount();
                }
            }
        } catch (e) {
            console.error('autoDeleteAndSync error', e);
        }
    }

    // ambil count saja dan update badge
    async function refreshNotifCount() {
        try {
            const res = await fetch(countUrl, { method: 'GET', headers: { 'Accept': 'application/json' }});
            if (!res.ok) return;
            const data = await res.json();
            if (data && typeof data.count !== 'undefined') {
                updateBadge(data.count);
            }
        } catch (e) {
            console.error('refreshNotifCount error', e);
        }
    }

    // jalankan segera sekali saat load untuk sinkron awal
    autoDeleteAndSync();
    refreshNotifCount();

    // polling berkala
    setInterval(autoDeleteAndSync, 30000); // auto-delete (30s)
    setInterval(refreshNotifCount, 10000);  // update badge (10s)
})();
</script>
