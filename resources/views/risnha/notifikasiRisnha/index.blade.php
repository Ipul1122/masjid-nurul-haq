@extends('layouts.risnha')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Notifikasi Risnha 
            <span class="badge bg-primary" id="notifCount">{{ $notifCount }}</span>
        </h3>
        <div>
            <form id="deleteSelectedForm" action="{{ route('risnha.notifikasiRisnha.destroySelected') }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus Terpilih</button>
            </form>
            <form action="{{ route('risnha.notifikasiRisnha.destroyAll') }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-dark btn-sm">Hapus Semua</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover" id="notifTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>No</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Tabel</th>
                        <th>Keterangan</th>
                        <th>Dibuat</th>
                        <th>Waktu Tersisa</th>
                    </tr>
                </thead>
                <tbody id="notifBody">
                    @foreach($notifikasi as $key => $n)
                        <tr id="notif-{{ $n->id }}">
                            <td><input type="checkbox" class="selectItem" value="{{ $n->id }}"></td>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $n->risnha->username ?? '-' }}</td>
                            <td>{{ $n->aksi }}</td>
                            <td>{{ $n->tabel }}</td>
                            <td>{{ $n->keterangan }}</td>
                            <td>{{ $n->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="timer" data-timestamp="{{ $n->created_at->addMinutes(5)->timestamp }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Select all checkbox
    document.getElementById('selectAll')?.addEventListener('click', function(e) {
        document.querySelectorAll('.selectItem').forEach(cb => cb.checked = e.target.checked);
    });

    // Update countdown timer
    function updateTimers() {
        const now = Math.floor(Date.now() / 1000);
        document.querySelectorAll('.timer').forEach(td => {
            const expire = parseInt(td.dataset.timestamp);
            let diff = expire - now;
            if (diff <= 0) {
                td.innerText = 'Expired';
            } else {
                let minutes = Math.floor(diff / 60);
                let seconds = diff % 60;
                td.innerText = `${minutes}m ${seconds}s`;
            }
        });
    }

    setInterval(updateTimers, 1000);
    updateTimers();

    // Auto refresh & hapus notifikasi expired di DB
    setInterval(() => {
        fetch("{{ route('risnha.notifikasiRisnha.autoDeleteOld') }}")
            .then(res => res.json())
            .then(data => {
                // Hapus row expired
                if (data.deleted_ids) {
                    data.deleted_ids.forEach(id => {
                        const row = document.getElementById(`notif-${id}`);
                        if (row) row.remove();
                    });
                }

                // Update badge count
                const notifCountElem = document.getElementById('notifCount');
                if (notifCountElem) {
                    notifCountElem.innerText = data.count;
                }

                // Tambahkan notifikasi baru jika ada
                const body = document.getElementById('notifBody');
                data.notifikasi.forEach((n, index) => {
                    if (!document.getElementById(`notif-${n.id}`)) {
                        const expire = new Date(n.created_at).getTime()/1000 + 300; // 5 menit
                        const tr = document.createElement('tr');
                        tr.id = `notif-${n.id}`;
                        tr.innerHTML = `
                            <td><input type="checkbox" class="selectItem" value="${n.id}"></td>
                            <td>${index + 1}</td>
                            <td>${n.id}</td>
                            <td>${n.risnha?.username ?? '-'}</td>
                            <td>${n.aksi}</td>
                            <td>${n.tabel}</td>
                            <td>${n.keterangan}</td>
                            <td>${new Date(n.created_at).toLocaleString()}</td>
                            <td class="timer" data-timestamp="${expire}"></td>
                        `;
                        body.prepend(tr);
                    }
                });
            });
    }, 10000); // tiap 10 detik
</script>
@endsection
