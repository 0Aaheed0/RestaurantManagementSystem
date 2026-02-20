<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function apply(Request $request)
{
    DB::insert("INSERT INTO staff_applications 
    (full_name, email, phone, position, experience, status, created_at, updated_at) 
    VALUES (?, ?, ?, ?, ?, 'pending', NOW(), NOW())", [
        $request->full_name,
        $request->email,
        $request->phone,
        $request->position,
        $request->experience
    ]);

    return back()->with('success', 'Application Submitted!');
}

public function approve($id)
{
    // Move to staff table
    DB::insert("INSERT INTO staff (full_name, email, phone, position, joined_at, created_at, updated_at)
        SELECT full_name, email, phone, position, NOW(), NOW(), NOW()
        FROM staff_applications
        WHERE id = ?", [$id]);

    // Update status
    DB::update("UPDATE staff_applications 
                SET status = 'approved', updated_at = NOW() 
                WHERE id = ?", [$id]);

    return back()->with('success', 'Staff Approved!');
}

public function reject($id)
{
    DB::update("UPDATE staff_applications 
                SET status = 'rejected', updated_at = NOW() 
                WHERE id = ?", [$id]);

    return back()->with('error', 'Application Rejected!');
}
}
