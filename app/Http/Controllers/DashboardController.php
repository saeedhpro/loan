<?php

namespace App\Http\Controllers;

use App\Interfaces\LoanInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected LoanInterface $loanRepository;

    public function __construct(
        LoanInterface $loanRepository,
    )
    {
        $this->loanRepository = $loanRepository;
    }

    public function showDashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        $statistics = $this->loanRepository->getStatistics();

        return view('dashboard', [
            'user' => $user,
            'statistics' => $statistics,
        ]);
    }
}
