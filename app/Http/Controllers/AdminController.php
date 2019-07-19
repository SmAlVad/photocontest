<?php

namespace App\Http\Controllers;

use App\Photocontest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $contests = Photocontest::all();

        return view('admin', compact('contests'));
    }
}
