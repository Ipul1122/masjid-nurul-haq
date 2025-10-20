@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'RISNHA - Remaja Islam Masjid Nurul Haq')

@section('styles')
<style>
    .card-kegiatan {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card-kegiatan:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .card-kegiatan a {
        text-decoration: none;
        color: inherit;
    }
</style>
@endsection

@section('content')
<div class="container py-5 mt-16">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Kegiatan RISNHA</h1>
        <p class="lead text-muted">Ikuti berbagai kegiatan menarik dan bermanfaat yang diselenggarakan oleh Remaja Islam Masjid Nurul Haq.</p>
    </div>

    @if($kegiatanRisnha->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada kegiatan yang dipublikasikan saat ini.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($kegiatanRisnha as $kegiatan)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($kegiatanRisnha as $kegiatan)
        <div class="col">
            {{-- Perbarui baris href di bawah ini --}}
            <a href="{{ route('penggunaMasjid.risnhaMasjid.show', ['kegiatan' => $kegiatan->id, 'slug' => $kegiatan->slug]) }}" class="card-link">
                <div class="card h-100 shadow-sm border-light card-kegiatan">
                    @if($kegiatan->foto)
                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" class="card-img-top" alt="{{ $kegiatan->nama }}" style="height: 200px; object-fit: cover;">
                    @else
                         <img src="https://via.placeholder.com/300x200.png?text=Tanpa+Gambar" class="card-img-top" alt="Tanpa Gambar" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $kegiatan->nama }}</h5>
                        <p class="card-text text-muted">
                            <small>
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ $kegiatan->created_at->translatedFormat('d F Y') }}
                            </small>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $kegiatanRisnha->links() }}
        </div>
    @endif
</div>
@endsection