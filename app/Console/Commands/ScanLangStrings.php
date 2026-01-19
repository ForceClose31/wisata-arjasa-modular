<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ScanLangStrings extends Command
{
    protected $signature = 'lang:scan';
    protected $description = 'Scan Blade files and extract translation strings grouped by view path';

    public function handle()
    {
        $viewPath = resource_path('views');
        $langBasePath = resource_path('lang/id');

        // Hapus cache lama kalau perlu
        if (!File::exists($langBasePath)) {
            File::makeDirectory($langBasePath, 0755, true);
        }

        $allStrings = [];

        foreach (File::allFiles($viewPath) as $file) {
            $contents = File::get($file);
            preg_match_all("/__\(['\"](.*?)['\"]\)/", $contents, $matches);
            if (empty($matches[1])) {
                continue;
            }

            // Tentukan nama file lang-nya berdasarkan path relative dari resources/views
            $relativePath = str_replace($viewPath . DIRECTORY_SEPARATOR, '', $file->getRealPath());
            $parts = explode(DIRECTORY_SEPARATOR, $relativePath);
            $langFile = Str::before(end($parts), '.blade.php'); // e.g., index.blade.php → index

            if (count($parts) > 1) {
                // Pakai direktori (e.g., about/index.blade.php → about.php)
                $langFile = $parts[0]; // e.g., about
            }

            if (!isset($allStrings[$langFile])) {
                $allStrings[$langFile] = [];
            }

            foreach ($matches[1] as $string) {
                $allStrings[$langFile][$string] = $string;
            }
        }

        // Simpan semua ke dalam file lang terpisah
        foreach ($allStrings as $filename => $strings) {
            $langFilePath = $langBasePath . '/' . $filename . '.php';
            ksort($strings); // urutkan berdasarkan key
            $langFileContent = "<?php\n\nreturn " . var_export($strings, true) . ";\n";
            File::put($langFilePath, $langFileContent);
            $this->info("✔️ Saved: lang/id/{$filename}.php (" . count($strings) . " keys)");
        }

        $this->info("✅ Selesai! Semua string berhasil discan.");
    }
}
