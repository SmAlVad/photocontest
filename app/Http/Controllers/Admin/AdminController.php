<?php

namespace App\Http\Controllers\Admin;

use App\Photocontest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $contests = Photocontest::all();

        return view('admin', compact('contests'));
    }
}
