<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorHistoryController extends Controller
{
    /**
     * Display the visitor history page.
     */
    public function index()
    {
        return view('visitor-history');
    }
}
