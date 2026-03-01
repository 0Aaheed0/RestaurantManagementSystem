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
        // Paginate results: 6 per page
        $branches = Branch::paginate(6);
        return view('branches.index', compact('branches'));
    }
}
