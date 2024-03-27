<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\scanerQR;
use Illuminate\Http\Request;
use Zxing\QrReader;

class ScanerQRController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->input('text');
        // Haz algo con el texto del código QR aquí

        return view('scanerQR.index', ['text' => $text]);
    }
}


