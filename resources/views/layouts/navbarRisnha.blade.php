<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Risnha</span>
        <div class="d-flex align-items-center">
            {{-- Notifikasi --}}
            @php
                // Jika admin (dkm) tampilkan semua, jika risnha tampilkan miliknya
                if(session()->has('dkm_id') || session()->get('is_admin') === true) {
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::count();
                } elseif(session()->has('risnha_id')) {
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::where('risnha_id', session('risnha_id'))->count();
                } else {
                    $jumlahNotifikasi = 0;
                }
            @endphp

            <a href="{{ route('risnha.notifikasiRisnha.index') }}" class="me-3 position-relative text-dark" title="Notifikasi">
                <i class="fas fa-bell fa-lg"></i>
                @if($jumlahNotifikasi > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $jumlahNotifikasi }}
                    </span>
                @endif
            </a>

            <span class="me-3">
                Halo, {{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}
            </span>
        </div>
    </div>
</nav>
