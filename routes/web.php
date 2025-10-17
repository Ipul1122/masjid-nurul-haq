<?php

// DKM ROUTES
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dkm\DkmAuthController;
use App\Http\Controllers\Dkm\DashboardController;
use App\Http\Controllers\Dkm\ManagePenggunaController;
use App\Http\Controllers\Dkm\VerifyPinController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\HomeSectionController;
use App\Http\Controllers\Dkm\TampilanPenggunaMasjid\VisiMisiController;
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

// ===================
// 📌 GENERAL ROUTES
// ===================
Route::get('/', [homeController::class, 'index'])->name('index');;
Route::get('/konten/{type}/{id}', [LihatKontenController::class, 'show'])->name('konten.show');
Route::get('/konten-masjid', [KontenMasjidController::class, 'index'])->name('penggunaMasjid.lihatKonten.kontenMasjid');
Route::get('/keuangan-masjid', [KeuanganMasjidController::class, 'index'])->name('penggunaMasjid.keuanganMasjid.index');
Route::get('/detail-pemasukkan-masjid', [DetailPemasukkanMasjidController::class, 'index'])->name('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid');
Route::get('/detail-pengeluaran-masjid', [DetailPengeluaranMasjidController::class, 'index'])->name('penggunaMasjid.keuanganMasjid.detailPengeluaranMasjid');
Route::get('/galeri-masjid', [GaleriMasjidController::class, 'index'])->name('penggunaMasjid.galeriMasjid.index');
Route::get('/kontak-masjid', [KontakMasjidController::class, 'index'])->name('penggunaMasjid.kontakMasjid.index');
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
            Route::resource('kegiatanRisnha', KegiatanRisnhaController::class);

            // ✅ Route untuk Artikel Risnha
            Route::get('artikelRisnha/preview/{artikelRisnha}', [ArtikelRisnhaController::class, 'preview'])->name('artikelRisnha.preview');
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
            Route::resource('visiMisi', VisiMisiController::class);
        });

        // ====================
        // 👥 Manajemen Pengguna (butuh PIN)
        // ====================
        Route::middleware('auth.dkm.pin')->group(function () {
            Route::resource('managePengguna', ManagePenggunaController::class);
        });
    });
});