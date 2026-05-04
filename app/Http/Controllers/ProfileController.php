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
        $listGame = $Profile->showGame($id);

        return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', 0)->with('listGame', $listGame)->with('arrayPtk', $Profile->arrayPtk);
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

    public function addCountry()
    {
        $Profile = new Profile;
        $listGroup = $Profile->showGroup();

        return View('profile.addCountry')->with('listGroup', $listGroup);
    }

    public function addGame()
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountryAll();

        return View('profile.addGame')->with('listCountry', $listCountry);
    }

    public function addCountrySubmit(Request $request)
    {

        $ProfileRequest = new ProfileRequest;
        $validate = $ProfileRequest->addCountry($request);
        if ($validate) {
            return $validate;
        } else {
            $Profile = new Profile;
            $Profile->saveCountry($request);
        }

    }

    public function showGroupForm(Request $request)
    {
        $Profile = new Profile;
        $listGroup = $Profile->showGroup();
        $listCountry = $Profile->showCountry($request->get('group'));
        $listGame = $Profile->showGame($request->get('group'));

        return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $request->get('group'))->with('arrayPtk', $Profile->arrayPtk)->with('listGame', $listGame);
    }

    public function addGameSubmit(Request $request)
    {
        $Profile = new Profile;
        $ProfileRequest = new ProfileRequest;

        $validate = $ProfileRequest->addGame($request);
        if ($validate) {
            return $validate;
        } else {

            $Profile->saveGame($request);
        }

    }

    public function showCountries()
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountryAll();

        return View('profile.showCountries')->with('listCountry', $listCountry);
    }

    public function showCountriesId(int $id)
    {
        $Profile = new Profile;
        $Profile->showCountriesById($id);

        return View('profile.showCountriesId')->with('listGamesGroup', $Profile->listGameGroup)
            ->with('listGamesFriendry', $Profile->listGameFriendry)
            ->with('listGamesCup', $Profile->listGameCup)
            ->with('idCountry', $id);
    }

    public function deleteGroup(int $id)
    {
        $Profile = new Profile;
        $Profile->deleteGroup($id);

        return Redirect::route('profile.showGroup', 1);
    }
    public function deleteCountry(int $id)
    {
        $Profile = new Profile;
        $Profile->deleteCountry($id);

        return Redirect::route('profile.showCountries');
    }
    public function deleteGame(int $id, int $idCountry)
    {
        $Profile = new Profile;
        $Profile->deleteGame($id);

        return Redirect::route('profile.showCountriesId', $idCountry);
    }
    public function editGame(int $id)
    {
        $Profile = new Profile;
        $game = $Profile->showGameById($id);

        return View('profile.editGame')->with('game', $game);
    }
    public function editGameSubmit(Request $request, int $id)
    {
        $Profile = new Profile;
        $ProfileRequest = new ProfileRequest;

        $validate = $ProfileRequest->editGame($request, $id);
        if ($validate) {
            return $validate;
        } else {

            $Profile->editGame($request, $id);
        }

    }

}
