<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class MapsController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.maps');
    }

    public function formmaps(Request $request)
    {
        return view('pages.formmaps');
    }

    public function storelokasi(Request $request)
    {
        Lokasi::create([
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect("All-Maps")->with('alert-success', 'Data successfully created');
    }

    public function allmaps(Request $request)
    {
        $locations = Lokasi::all();
        return view('pages.allmaps', compact('locations'));
    }
}
