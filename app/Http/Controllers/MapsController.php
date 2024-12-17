<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.maps');
    }
}
