<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        switch (auth()->user()?->role) {
            case 'member':
                // return redirect()->route('member.dashboard', ['role' => 'member']);
                return to_route('member.dashboard');
            case 'instructor':
                return to_route('instructor.dashboard');
            case 'admin':
                return to_route('admin.dashboard');
            default:
                return to_route('login');
        }
    }

    // public function show($role)
    // {
    //     return View::exists("$role.dashboard") ? view("$role.dashboard") : abort(404);
    // }

    public function member()
    {
        return view('member.dashboard');
    }

    public function instructor()
    {
        return view('instructor.dashboard');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }
}
