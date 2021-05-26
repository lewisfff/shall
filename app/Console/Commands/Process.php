<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Process extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process uploaded images to distributable format';

    public $manager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->manager = new ImageManager(array('driver' => env('IMAGE_PROCESSOR', 'gd')));
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $start = now();
        $this->comment('Starting');

        $directories = Storage::disk('photos')->allDirectories();
        $photos = Storage::disk('photos')->allFiles();
        $image_width = Config::get('photo.width');
        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/svg+xml'];

        if (Storage::get('photos.json') !== null) {
            $json = json_decode(Storage::get('photos.json'));
        } else {
            $json = [];
        }

        foreach ($directories as $directory) {
            Storage::disk('public')->makeDirectory($directory);
            Storage::disk('thumbnail')->makeDirectory($directory);
        }

        foreach ($photos as $photo) {
            if (Storage::disk('public')->missing($photo) || Storage::disk('thumbnail')->missing($photo)) {
                $source_photo = Storage::disk('photos')->path($photo);
                $contentType = mime_content_type($source_photo);
                if (in_array($contentType, $allowedMimeTypes)) {
                    $this->info('Processing photo ' . $photo);

                    $image = $this->manager->make($source_photo);
                    $image->orientate();
                    $image->resize($image_width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save(public_path() . '/storage/' . $photo, 88, 'jpg');

                    $json->{$photo} = [
                        'height' => $image->height(),
                        'width' => $image_width,
                    ];

                    $image->resize($image_width / 10, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save(storage_path() . '/app/thumbnail/' . $photo, 77, 'jpg');
                }
            }
        }

        Storage::put('photos.json', json_encode($json));

        $time = $start->diffInSeconds(now());
        $this->comment("Processed in $time seconds");

        return 0;
    }
}
