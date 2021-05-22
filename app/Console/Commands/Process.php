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

        foreach ($directories as $directory) {
            Storage::disk('public')->makeDirectory($directory);
            Storage::disk('public')->makeDirectory('/thumbnail/' . $directory);
        }

        foreach ($photos as $photo) {
            if (Storage::disk('public')->missing($photo)) {
                $this->info('Processing photo ' . $photo);

                $source_photo = Storage::disk('photos')->path($photo);
                $image = $this->manager->make($source_photo);
                $image->orientate();
                $image->resize($image_width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $image->save(public_path() . '/storage/' . $photo, 92, 'jpg');

                $image->resize($image_width / 10, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path() . '/storage/thumbnail/' . $photo, 77, 'jpg');
            }
        }

        $time = $start->diffInSeconds(now());
        $this->comment("Processed in $time seconds");

        return 0;
    }
}
