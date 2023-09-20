<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LoanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('index_request_loans');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Loan $loan): bool
    {
        return $user->hasPermission('index_request_loans');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('request_loan');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Loan $loan): bool
    {
        return $user->id == $loan->user_id || $user->hasPermission('accept_reject_loan');
    }

    /**
     * Determine whether the user can action on the model.
     */
    public function acceptOrReject(User $user, Loan $loan): bool
    {
        return $user->hasPermission('accept_reject_loan');
    }

    /**
     * Determine whether the user can action on the model.
     */
    public function cancel(User $user, Loan $loan): bool
    {
        return $user->id == $loan->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Loan $loan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Loan $loan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Loan $loan): bool
    {
        //
    }
}
