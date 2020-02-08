<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DNS1D;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('barcode');
    }
}
