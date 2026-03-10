<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all branches to display on a single page
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }
}
