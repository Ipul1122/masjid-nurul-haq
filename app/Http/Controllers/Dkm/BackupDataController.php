<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class BackupDataController extends Controller
{
    public function index()
    {
        return view('dkm.manajemenPengaturan.backupData.index');
    }

public function backup()
{
    $db   = env('DB_DATABASE', 'masjid_nurul_haq');
    $user = env('DB_USERNAME', 'root');
    $pass = env('DB_PASSWORD', '');
    $host = env('DB_HOST', '127.0.0.1');

    $fileName = "backup_{$db}_" . date('Y-m-d_H-i-s') . ".sql";
    $filePath = storage_path("app/{$fileName}");

    // Lokasi mysqldump di XAMPP
    $mysqldumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

    if (empty($pass)) {
        $command = "\"{$mysqldumpPath}\" -h {$host} -u {$user} {$db} > \"{$filePath}\" 2>&1";
    } else {
        $command = "\"{$mysqldumpPath}\" -h {$host} -u {$user} -p{$pass} {$db} > \"{$filePath}\" 2>&1";
    }

    exec($command, $output, $returnVar);

    if ($returnVar !== 0) {
        dd("Gagal backup", $command, $output);
    }

    if (!file_exists($filePath) || filesize($filePath) === 0) {
        return back()->with('error', 'Backup gagal dibuat atau file kosong.');
    }

    return response()->download($filePath)->deleteFileAfterSend(true);
}

}
