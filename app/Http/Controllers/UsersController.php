<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth; // <-- ADDED THIS FOR LOGIN

class UsersController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->userService->getUsers();
    }

    /**
     * --- NEW: LOGIN METHOD ADDED HERE ---
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        // 1. Validate the form inputs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Try to log the user in using the provided credentials
        if (Auth::attempt($credentials)) {
            // Success: Regenerate session and redirect to intended dashboard page
            $request->session()->regenerate();
            
            // Note: Change 'dashboard' to whatever your actual homepage route is named!
            return redirect()->intended('dashboard'); 
        }

        // 3. Failure: Send them back to the login page with an error. 
        // This is what triggers the SweetAlert popup in your blade file!
        return back()->withErrors([
            'email' => 'The provided email or password is incorrect.',
        ])->onlyInput('email'); // Keeps their email in the input box
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            'data' => [
                'id' => $id,
                'name' => 'Item ' . $id,
                'description' => 'Description for item ' . $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage. (Sign-Up Logic)
     */
    public function store(Request $request)
    {
        // --- VALIDATION FOR REGISTRATION ---
        $validatedData = $request->validate([
            'name'     => ['required', 'string', 'regex:/^[^0-9]+$/'], 
            'email'    => ['required', 'email'],                       
            'password' => ['required', 'min:8', 'confirmed'],          
        ], [
            'name.regex' => 'The name field cannot contain numbers.',
        ]);

        $body = $request->json();

        logger()->info('POST /items - Request body:', ['body' => $body]);
        logger()->info('POST /items - All request data:', $request->all());

        return response()->json([
            'message' => 'User validated and processed successfully',
            'data' => [
                'id' => rand(100, 999),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'created_at' => now(),
            ]
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Item updated successfully',
            'data' => [
                'id' => $id,
                'name' => $request->input('name', 'Updated Item'),
                'description' => $request->input('description', 'Updated description'),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Partially update the specified resource in storage.
     */
    public function patch(Request $request, $id)
    {
        return response()->json([
            'message' => 'Item partially updated successfully',
            'data' => [
                'id' => $id,
                'name' => $request->input('name', 'Partially Updated Item'),
                'description' => $request->input('description', 'Partially updated description'),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => 'Item deleted successfully',
            'data' => [
                'id' => $id,
            ]
        ]);
    }
}