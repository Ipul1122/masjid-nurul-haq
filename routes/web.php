<?php

// DKM ROUTES
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dkm\DkmAuthController;
use App\Http\Controllers\Dkm\DashboardController;
use App\Http\Controllers\Dkm\ManagePenggunaController;
use App\Http\Controllers\Dkm\VerifyPinController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\HomeSectionController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\VisiMisiController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\SejarahController;
use App\Http\Controllers\Dkm\ManajemenKontenController\KegiatanMasjidController;
use App\Http\Controllers\Dkm\ArtikelController;
use App\Http\Controllers\Dkm\KategoriController;
use App\Http\Controllers\Dkm\KategoriKegiatanMasjidController;
use App\Http\Controllers\Dkm\KategoriArtikelController;
use App\Http\Controllers\Dkm\JadwalImamController;
use App\Http\Controllers\Dkm\PemasukkanController;
use App\Http\Controllers\Dkm\KategoriPemasukkanController;
use App\Http\Controllers\Dkm\PengeluaranController;
use App\Http\Controllers\Dkm\KategoriPengeluaranController;
use App\Http\Controllers\Dkm\ManajemenKeuanganController;
use App\Http\Controllers\Dkm\GaleriController;
use App\Http\Controllers\Dkm\KategoriGaleriController;
use App\Http\Controllers\Dkm\NotifikasiController;
use App\Http\Controllers\Dkm\BackupDataController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\BuktiDonasiMasjidController;


// Risnha Routes
use App\Http\Controllers\Risnha\AuthController;
use App\Http\Controllers\Risnha\DashboardRisnhaController;
// Manajemen Konten Risnha
use App\Http\Controllers\Risnha\KegiatanRisnhaController;
use App\Http\Controllers\Risnha\ArtikelRisnhaController;
use App\Http\Controllers\Risnha\GaleriRisnhaController;
// 
use App\Http\Controllers\Risnha\ManajemenPenggunaRisnhaController;
use App\Http\Controllers\Risnha\NotifikasiRisnhaController;
// Kategori Risnha ROUTES
use App\Http\Controllers\Risnha\KategoriKegiatanRisnhaController;
use App\Http\Controllers\Risnha\KategoriArtikelRisnhaController;
use App\Http\Controllers\Risnha\KategoriGaleriRisnhaController;

// USER ROUTES
use App\Http\Controllers\penggunaMasjid\homeController;
use App\Http\Controllers\penggunaMasjid\LihatKontenController;
use App\Http\Controllers\PenggunaMasjid\KontenMasjidController;
use App\Http\Controllers\PenggunaMasjid\KeuanganMasjidController;
use App\Http\Controllers\PenggunaMasjid\DetailPemasukkanMasjidController;
use App\Http\Controllers\PenggunaMasjid\DetailPengeluaranMasjidController;
use App\Http\Controllers\PenggunaMasjid\GaleriMasjidController;
use App\Http\Controllers\PenggunaMasjid\KontakMasjidController;
use App\Http\Controllers\PenggunaMasjid\VisiDanMisiController;
use App\Http\Controllers\PenggunaMasjid\SejarahMasjidController;
use App\Http\Controllers\PenggunaMasjid\DonasiMasjidController;
use App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController\RisnhaHomeController;
use App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController\LihatKontenRisnhaController;

// ===================
// 📌 GENERAL ROUTES
// ===================
// Route untuk konten masjid biasa
Route::get('/', [homeController::class, 'index'])->name('index');
Route::get('/konten/{type}/{id}', [LihatKontenController::class, 'show'])->name('konten.show');

// ===============================================
//  ROUTES GROUP UNTUK PENGGUNA MASJID
// ===============================================
Route::name('penggunaMasjid.')->group(function () {
    
    Route::get('/konten-masjid', [KontenMasjidController::class, 'index'])->name('lihatKonten.kontenMasjid');

    // == PENGGUNA MASJID ROUTES UNTUK KEUANGAN ==
    Route::name('keuanganMasjid.')->group(function () {
        Route::get('/keuangan-masjid', [KeuanganMasjidController::class, 'index'])->name('index');
        Route::get('/detail-pemasukkan-masjid', [DetailPemasukkanMasjidController::class, 'index'])->name('detailPemasukkanMasjid');
        Route::get('/detail-pengeluaran-masjid', [DetailPengeluaranMasjidController::class, 'index'])->name('detailPengeluaranMasjid');
    });

    // == PENGGUNA MASJID ROUTES UNTUK GALERI ==
    Route::get('/galeri-masjid', [GaleriMasjidController::class, 'index'])->name('galeriMasjid.index');
    
    // == PENGGUNA MASJID ROUTES UNTUK KONTAK ==
    Route::get('/kontak-masjid', [KontakMasjidController::class, 'index'])->name('kontakMasjid.index');

    // == PENGGUNA MASJID ROUTES UNTUK PROFILE ==
    Route::name('profile.')->group(function () {
        Route::get('/visi-dan-misi-masjid', [VisiDanMisiController::class, 'index'])->name('visiMisiMasjid');
        Route::get('/sejarah-masjid', [SejarahMasjidController::class, 'index'])->name('sejarahMasjid');
    });

    // == PENGGUNA MASJID ROUTES UNTUK DONASI ==
    Route::prefix('penggunaMasjid/donasi')->name('donasi.')->group(function () {
        Route::get('/donasi-masjid', [DonasiMasjidController::class, 'index'])->name('index');
        Route::get('/kirimBukti', [DonasiMasjidController::class, 'kirimBukti'])->name('kirimBukti');
        Route::post('/kirimBukti', [DonasiMasjidController::class, 'storeBukti'])->name('kirimBukti.store');
        Route::get('/hasil', [DonasiMasjidController::class, 'hasilDonasi'])->name('hasilDonasi');
    });

    // == PENGGUNA MASJID ROUTES UNTUK RISNHA ==
    Route::prefix('penggunaMasjid/risnhaMasjid')->name('risnhaMasjid.')->group(function () {
Route::get('/lihat-konten/{tipe}/{id}', [LihatKontenRisnhaController::class, 'show'])->name('lihatKonten');

        Route::get('/risnha-masjid', [RisnhaHomeController::class, 'index'])->name('index');
        Route::get('/kegiatan/{kegiatan}/{slug?}', [RisnhaHomeController::class, 'show'])->name('show');
        Route::get('/artikel/{artikel}/{slug?}', [RisnhaHomeController::class, 'showArtikel'])->name('showArtikel');
    });
});
// ===================
// 📌 RISNHA ROUTES
// ===================

Route::prefix('risnha')->name('risnha.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::middleware('risnha.auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [DashboardRisnhaController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        // Manajemen Konten Risnha
        Route::prefix('manajemenKontenRisnha')->name('manajemenKontenRisnha.')->group(function () {
            // Tambahkan route ini sebelum resource controller
            Route::get('kegiatan-risnha/{id}/preview', [KegiatanRisnhaController::class, 'preview'])->name('kegiatanRisnha.preview');
            Route::patch('kegiatan-risnha/{id}/publish', [KegiatanRisnhaController::class, 'publish'])->name('kegiatanRisnha.publish');
            Route::resource('kegiatan-risnha', KegiatanRisnhaController::class, ['names' => 'kegiatanRisnha']);
            Route::resource('kegiatanRisnha', KegiatanRisnhaController::class);

            // ✅ Route untuk Artikel Risnha
            Route::get('artikel-risnha/{id}/preview', [ArtikelRisnhaController::class, 'preview'])->name('artikelRisnha.preview');
            Route::patch('artikel-risnha/{id}/publish', [ArtikelRisnhaController::class, 'publish'])->name('artikelRisnha.publish');
            // Route::get('artikelRisnha/preview/{artikelRisnha}', [ArtikelRisnhaController::class, 'preview'])->name('artikelRisnha.preview');
            Route::resource('artikelRisnha', ArtikelRisnhaController::class);
            Route::resource('galeriRisnha', GaleriRisnhaController::class);
        });
        // ✅ Group kategori
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::resource('kegiatanRisnha', KategoriKegiatanRisnhaController::class);
            Route::resource('artikelRisnha', KategoriArtikelRisnhaController::class);
            Route::resource('galeriRisnha', KategoriGaleriRisnhaController::class);
        });

        Route::resource('manajemenPenggunaRisnha', ManajemenPenggunaRisnhaController::class)
        ->names('manajemenPenggunaRisnha')
        ->except(['show']);

        Route::get('/notifikasi', [NotifikasiRisnhaController::class, 'index'])->name('notifikasiRisnha.index');
        Route::delete('/notifikasi/destroy-selected', [NotifikasiRisnhaController::class, 'destroySelected'])->name('notifikasiRisnha.destroySelected');
        Route::delete('/notifikasi/destroy-all', [NotifikasiRisnhaController::class, 'destroyAll'])->name('notifikasiRisnha.destroyAll');

        // Tambahan untuk auto delete & count
        Route::get('/notifikasi/auto-delete-old', [NotifikasiRisnhaController::class, 'autoDeleteOld'])->name('notifikasiRisnha.autoDeleteOld');
        Route::get('/notifikasi/count', [NotifikasiRisnhaController::class, 'count'])->name('notifikasiRisnha.count');
    });
});


// ====================
// 📌 DKM Routes
// ====================
Route::prefix('dkm')->name('dkm.')->group(function () {
    
    // 🔐 Auth
    Route::get('/login', [DkmAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [DkmAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [DkmAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth.dkm')->group(function () {
        Route::get('/dashboard', [DkmAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // ====================
        // 📌 Manajemen Konten
        // ====================
        Route::prefix('manajemenKonten')->name('manajemenKonten.')->group(function () {
            
            
            Route::get('kegiatanMasjid/{kegiatanMasjid}/preview', [KegiatanMasjidController::class, 'preview'])
                ->name('kegiatanMasjid.preview');
            
            Route::put('kegiatanMasjid/{kegiatan}/publish', [KegiatanMasjidController::class, 'publish'])
                ->name('kegiatanMasjid.publish');
            
            // Resource controller HARUS di akhir
            Route::resource('kegiatanMasjid', KegiatanMasjidController::class);

            
            // --- Artikel Masjid & Jadwal Imam ---
            Route::delete('artikel/bulk-delete', [ArtikelController::class, 'bulkDelete'])->name('artikel.bulkDelete');
            
            Route::get('artikel/preview', [ArtikelController::class, 'previewPage'])->name('artikel.previewPage');
            
            Route::get('artikel/preview/{artikel}', [ArtikelController::class, 'preview'])->name('artikel.preview');
            Route::put('artikel/{artikel}/publish', [ArtikelController::class, 'publish'])->name('artikel.publish');
            
            Route::resource('artikel', ArtikelController::class);
            Route::resource('jadwalImam', JadwalImamController::class);
        });
        
        // ====================
        // 📌 Manajemen Keuangan
        // ====================
        Route::prefix('manajemenKeuangan')->name('manajemenKeuangan.')->group(function () {
            // Manajemen Keuangan
            Route::get('/', [ManajemenKeuanganController::class, 'index'])->name('index');
            
            // Hapus multiple pemasukkan
            Route::delete('/pemasukkan/bulk-delete', [PemasukkanController::class, 'bulkDelete'])
                ->name('pemasukkan.bulkDelete');
            
            // Hapus multiple pengeluaran
            Route::delete('/pengeluaran/bulk-delete', [PengeluaranController::class, 'bulkDelete'])
                ->name('pengeluaran.bulkDelete');
            
            // Pemasukkan
            Route::resource('pemasukkan', PemasukkanController::class);
            
            // Pengeluaran
            Route::resource('pengeluaran', PengeluaranController::class);
        });

        // ====================
        // 📌 Manajemen Fasilitas
        // ====================
        Route::prefix('manajemenFasilitas')->name('manajemenFasilitas.')->group(function () {
            // Galeri
            Route::resource('galeri', GaleriController::class);
        });

        // ====================
        // 📌 Kategori
        // ====================
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('index'); 
            Route::resource('kegiatanMasjid', KategoriKegiatanMasjidController::class);
            Route::resource('artikel', KategoriArtikelController::class);
            Route::resource('pemasukkan', KategoriPemasukkanController::class);
            Route::resource('pengeluaran', KategoriPengeluaranController::class);
            Route::resource('galeri', KategoriGaleriController::class);
        });

        // ====================
        // 🔔 Notifikasi
        // ====================
        Route::delete('notifikasi/auto-delete-old', [NotifikasiController::class, 'autoDeleteOld'])
            ->name('notifikasi.autoDeleteOld');
        
        Route::get('notifikasi/count', [NotifikasiController::class, 'count'])
            ->name('notifikasi.count');
        
        Route::delete('notifikasi/bulk-delete', [NotifikasiController::class, 'bulkDelete'])
            ->name('notifikasi.bulkDelete');
        
        Route::resource('notifikasi', NotifikasiController::class);

        // ====================
        // 🔐 Verifikasi PIN
        // ====================
        Route::get('/verify-pin', [VerifyPinController::class, 'showVerifyForm'])->name('verifyPinForm');
        Route::post('/verify-pin', [VerifyPinController::class, 'verify'])->name('verifyPin');

        // ================
        // ⚙️ Manajemen Pengaturan
        // ===============
        Route::prefix('manajemenPengaturan')->name('manajemenPengaturan.')->group(function () {
            // Backup Data
            Route::get('backupData', [BackupDataController::class, 'index'])->name('backupData.index');
            Route::post('backupData/backup', [BackupDataController::class, 'backup'])->name('backupData.run');
        });

        // 🧑 Manajemen Tampilan Pengguna Masjid
        Route::prefix('tampilanPenggunaMasjid')->name('tampilanPenggunaMasjid.')->group(function () {
            Route::get('homeSection', [HomeSectionController::class, 'index'])->name('homeSection.index');
            Route::post('homeSection', [HomeSectionController::class, 'store'])->name('homeSection.store');
            Route::delete('homeSection/{homeSection}', [HomeSectionController::class, 'destroy'])->name('homeSection.destroy');
            Route::get('runningText', [HomeSectionController::class, 'runningText'])->name('runningText.index');
            Route::post('runningText', [HomeSectionController::class, 'storeRunningText'])->name('runningText.store');
            Route::resource('sejarah', SejarahController::class);
            Route::resource('visiMisi', VisiMisiController::class);
            // Verifikasi Donasi
            Route::get('/bukti-donasi', [BuktiDonasiMasjidController::class, 'index'])->name('buktiDonasi.index');
            Route::patch('/bukti-donasi/{donasi}/verify', [BuktiDonasiMasjidController::class, 'verify'])->name('buktiDonasi.verify');
            Route::delete('/bukti-donasi/{donasi}/reject', [BuktiDonasiMasjidController::class, 'reject'])->name('buktiDonasi.reject');
        });

        
        // ====================
        // 👥 Manajemen Pengguna (butuh PIN)
        // ====================
        Route::middleware('auth.dkm.pin')->group(function () {
            Route::resource('managePengguna', ManagePenggunaController::class);
        });
    });
}); 