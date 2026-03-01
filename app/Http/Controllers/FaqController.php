<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = DB::table('faqs')->get();
        return view('faq', compact('faqs'));
    }
}
