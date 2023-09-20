<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Interfaces\PermissionInterface;
use App\Interfaces\UserInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected UserInterface $userRepository;
    protected PermissionInterface $permissionRepository;

    public function __construct(
        UserInterface $userRepository,
        PermissionInterface $permissionRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = $this->getAuth();
        $roles = [
            [
                'name' => 'مدیرکل',
                'id' => 'admin'
            ],
            [
                'name' => 'کارمند',
                'id' => 'employer'
            ]
        ];
        $permissions = $this->permissionRepository->all('*', 'id', 'asc');
        $success = false;
        $error = '';
        return view('profile.edit', compact('user', 'roles', 'permissions', 'success', 'error'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
