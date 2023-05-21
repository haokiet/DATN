<?php

namespace App\Http\Controllers;

use App\Models\Binhluan;
use Illuminate\Http\Request;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */
}
