@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'RISNHA - Remaja Islam Masjid Nurul Haq')

@section('content')
<div class="container py-5 mt-16">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Konten Terbaru RISNHA</h1>
        <p class="lead text-muted">Ikuti berbagai kegiatan dan baca artikel menarik dari Remaja Islam Masjid Nurul Haq.</p>
    </div>

    @if($kontenRisnha->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada konten yang dipublikasikan saat ini.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($kontenRisnha as $konten)
                <div class="col">
                    @php
                        // Tentukan route berdasarkan tipe konten
                        $route = $konten->type === 'kegiatan'
                            ? route('penggunaMasjid.risnhaMasjid.show', ['kegiatan' => $konten->id, 'slug' => $konten->slug])
                            : route('penggunaMasjid.risnhaMasjid.showArtikel', ['artikel' => $konten->id, 'slug' => $konten->slug]);
                    @endphp
                    <a href="{{ $route }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm border-light" style="transition: transform 0.2s ease-in-out;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                            
                            <div class="position-relative">
                                @if($konten->gambar)
                                    <img src="{{ asset('storage/' . $konten->gambar) }}" class="card-img-top" alt="{{ $konten->judul }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/300x200.png?text=Tanpa+Gambar" class="card-img-top" alt="Tanpa Gambar" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="position-absolute top-0 end-0 m-2">
                                    @if($konten->type == 'artikel')
                                        <span class="badge bg-success">Artikel</span>
                                    @else
                                        <span class="badge bg-primary">Kegiatan</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $konten->judul }}</h5>
                                <p class="card-text text-muted">
                                    <small>
                                        <i class="fa fa-calendar-alt me-1"></i>
                                        {{ $konten->created_at->translatedFormat('d F Y') }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection