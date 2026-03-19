<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

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

    public function showGroup(int $id = 1)
    {
        $Profile = new Profile;
        $listGroup = $Profile->showGroup();
        $listCountry = $Profile->showCountry($id);

        return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry);
    }

    public function addGroup()
    {
        return View('profile.addGroup');
    }

    public function addGroupSubmit(Request $request)
    {

        $ProfileRequest = new ProfileRequest;
        $validate = $ProfileRequest->addGroup($request);
        if ($validate) {
            return $validate;
        } else {
            $Profile = new Profile;
            $Profile->saveGroup($request->get('name'));
        }

    }
}
