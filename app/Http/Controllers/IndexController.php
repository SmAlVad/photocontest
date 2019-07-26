<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use \App\Photocontest;

class IndexController extends Controller
{
    public function index()
    {
        return redirect()->route('krpz');
    }
}
