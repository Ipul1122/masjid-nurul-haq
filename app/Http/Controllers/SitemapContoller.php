<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\ArtikelRisnha;
use App\Models\KegiatanRisnha;
use App\Models\GaleriRisnha;
use Carbon\Carbon;

class SitemapContoller extends Controller
{
    /**
     * Generate the sitemap.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request) // <-- Perbaikan #1: Tambahkan Request $request
    {
        $sitemap = Sitemap::create();

        // 1. Halaman Statis (Homepage, Kontak, dll.)
        $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/kontak')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.5));
            
        $sitemap->add(Url::create('/keuangan')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.7));

        $sitemap->add(Url::create('/donasi')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.6));
            
        // Halaman statis Risnha
        $sitemap->add(Url::create('/risnha')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8));
        
        $sitemap->add(Url::create('/risnha/kontak')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.5));
            

        // 2. Halaman Dinamis (Artikel, Kegiatan, Galeri Masjid)
        // (Asumsi route Anda 'artikel.show', 'kegiatan.show', dst. Sesuaikan jika beda)

        // Artikel DKM
        Artikel::all()->each(function(Artikel $artikel) use ($sitemap) {
            $sitemap->add(Url::create(route('konten.show', $artikel->slug)) // <-- Sesuaikan 'konten.show' dengan nama route Anda
                ->setLastModificationDate($artikel->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        });

        // Kegiatan DKM
        Kegiatan::all()->each(function(Kegiatan $kegiatan) use ($sitemap) {
            $sitemap->add(Url::create(route('konten.show', $kegiatan->slug)) // <-- Sesuaikan jika nama route-nya sama
                ->setLastModificationDate($kegiatan->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        });

        // Galeri DKM
        $sitemap->add(Url::create('/galeri')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.7));

        // 3. Halaman Dinamis Risnha
        
        // Artikel Risnha
        ArtikelRisnha::all()->each(function(ArtikelRisnha $artikel) use ($sitemap) {
            $sitemap->add(Url::create(route('risnha.konten.show', $artikel->slug)) // <-- Sesuaikan nama route
                ->setLastModificationDate($artikel->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        });

        // Kegiatan Risnha
        KegiatanRisnha::all()->each(function(KegiatanRisnha $kegiatan) use ($sitemap) {
            $sitemap->add(Url::create(route('risnha.konten.show', $kegiatan->slug)) // <-- Sesuaikan nama route
                ->setLastModificationDate($kegiatan->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        });
        
        // Galeri Risnha
        $sitemap->add(Url::create('/risnha/galeri')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.7));

        // Generate sitemap dan kirim sebagai response XML
        return $sitemap->toResponse($request); // <-- Perbaikan #2: Masukkan $request di sini
    }
}