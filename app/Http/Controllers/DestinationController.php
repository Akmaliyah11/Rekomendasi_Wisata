<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function show($id)
    {
        $d = Destination::find($id);

        if (!$d) {
            return redirect()->route('home')->with('error', 'Destinasi tidak ditemukan.');
        }

        return view('wisata.show', compact('d'));
    }
}
