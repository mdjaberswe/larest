<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Download a file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        return response()->download(storage_path('app/download/yts.jpg'), 'torrent_movie');
    }

    /**
     * Store a file.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'path' => $request->file('photo')->store('testing'),
        ], 200);
    }
}
