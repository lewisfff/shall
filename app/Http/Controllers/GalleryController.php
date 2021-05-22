<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    function view($page = null)
    {
        if ($page === null) {
            $page = Storage::disk('public')->allDirectories();
            $page = array_pop($page);
        }

        $photos = Storage::disk('public')->allFiles($page);
        $meta = json_decode(Storage::get('photos.json'));

        $directories = array_reverse(Storage::disk('public')->directories());

        if (($key = array_search('thumbnail', $directories)) !== false) {
            unset($directories[$key]);

        }

        return view('gallery', compact('photos', 'meta', 'page', 'directories'));
    }
}
