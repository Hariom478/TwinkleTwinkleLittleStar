<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        $role = Auth::user()?->role;



        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();


         // 🔥 Redirect based on role
        if ($role == 'admin')
        {
            redirect()->route('login');
        } else
        {
            redirect()->route('user.dashboard');
        }

    }
}
