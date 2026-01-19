<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth

class AccountController extends Controller
{
    // Show account/profile page
    public function index()
    {
        // Get currently authenticated user
        $user = Auth::user();

        // Pass user data to the view
        return view('account.index', compact('user'));
    }
}
