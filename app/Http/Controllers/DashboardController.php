<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('dashboard', [
            'user' => $user,
        ]);
    }
}
