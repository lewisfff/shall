<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    function view( $page = null )
    {
        if ($page === null) {
            $page = Storage::disk('public')->allDirectories();
            $page = array_pop($page);
        }

        $photos = Storage::disk('public')->allFiles($page);

        $directories = array_reverse(Storage::disk('public')->directories());

        return view('gallery', compact('photos', 'page', 'directories'));
    }
}
