<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class MediaStorage
{
    /**
     * @return list<string>
     */
    public static function uploadDirectories(): array
    {
        $directories = [public_path('assets/uploads')];

        $rootAssets = dirname(base_path()).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'uploads';

        if ($rootAssets !== public_path('assets/uploads') && is_dir(dirname($rootAssets))) {
            $directories[] = $rootAssets;
        }

        return array_values(array_unique($directories));
    }

    public static function storeUploadedFile(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $filename = Str::uuid()->toString().'.'.$extension;

        foreach (self::uploadDirectories() as $directory) {
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }

        $primary = self::uploadDirectories()[0];
        $file->move($primary, $filename);

        foreach (array_slice(self::uploadDirectories(), 1) as $directory) {
            $target = $directory.DIRECTORY_SEPARATOR.$filename;
            if (! is_file($target)) {
                copy($primary.DIRECTORY_SEPARATOR.$filename, $target);
            }
        }

        return '/assets/uploads/'.$filename;
    }

    public static function syncExistingUploads(): int
    {
        $copied = 0;
        $directories = self::uploadDirectories();

        if (count($directories) < 2) {
            return 0;
        }

        $source = $directories[0];

        if (! is_dir($source)) {
            return 0;
        }

        foreach (array_slice($directories, 1) as $directory) {
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            foreach (glob($source.'/*') ?: [] as $path) {
                if (! is_file($path)) {
                    continue;
                }

                $target = $directory.DIRECTORY_SEPARATOR.basename($path);

                if (is_file($target)) {
                    continue;
                }

                if (copy($path, $target)) {
                    $copied++;
                }
            }
        }

        return $copied;
    }
}
