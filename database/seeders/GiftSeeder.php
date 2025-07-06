<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gift;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class GiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $giftFolder = public_path('gifts');
        $files = File::files($giftFolder);
        $index = 1;

        foreach ($files as $file) {
            // Generate new name
            $extension = $file->getExtension();
            $newName = "gift{$index}." . $extension;
            $newPath = $giftFolder . DIRECTORY_SEPARATOR . $newName;

            // Rename the file
            File::move($file->getPathname(), $newPath);

            // Create Gift record
            $gift = Gift::create([
                'name' => "gift$index",
                'price' => rand(1, 10), // or your logic
            ]);

            // Attach media
            $gift->addMedia($newPath)->preservingOriginal()->toMediaCollection('icon');

            $index++;
        }
    }
}
