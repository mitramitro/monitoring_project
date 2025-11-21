<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function display()
    {
        // nanti kita isi query datanya di sini
        return view('pages.display.index');
    }
}
