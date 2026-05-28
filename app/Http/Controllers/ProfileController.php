<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\Profile;
use App\Models\Group;
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

    public function showGroup()
    {
        $Profile = new Profile;
        $number  =$Profile->loadSessionOldGroup();
        $listGroup = $Profile->showGroup($number);
        $result =  $Profile->calculateCup($number);
        $listOldGroup = $Profile->chcekOldGroup();

        if (count($listGroup) == 0) {
            return View('profile.showGroupError')->with('listOldGroup', $listOldGroup);
        }
        $id = $Profile->whereIdFirstGroup($number);
        $listCountry = $Profile->showCountry($id, $number);
        $listGame = $Profile->showGame($id, $number);
        if (count($listCountry) == 0) {
            return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $id)->with('result', $result)->with('ifEndGroup', false)->with('listGame', $listGame)->with('listOldGroup', $listOldGroup);
        }

        $sumMForAllGroup = $Profile->sumMForAllGroup($number);
        $ifEndGroup = $Profile->ifEndGroup($sumMForAllGroup);



        return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $id)->with('listGame', $listGame)->with('arrayPtk', $Profile->arrayPtk)
            ->with('ifEndGroup', $ifEndGroup)->with('result', $result)->with('listOldGroup', $listOldGroup);
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
        $number = $Profile->loadSessionOldGroup();
        $listGroup = $Profile->showGroup($number);
        $listOldGroup = $Profile->chcekOldGroup();


        if (count($listGroup) == 0) {
            return View('profile.showGroupError')->with('listOldGroup', $listOldGroup);
        }
        $listCountry = $Profile->showCountry($request->get('group'), $number);
        $result =  $Profile->calculateCup($number);
        $request->request->remove('group');

        $listGame = $Profile->showGame($request->get('group'), $number);
        if (count($listCountry) == 0) {
            return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $request->get('group'))->with('result', $result)->with('ifEndGroup', false)
            ->with('listGame', $listGame)->with('listOldGroup', $listOldGroup);
        }

        $sumMForAllGroup = $Profile->sumMForAllGroup($number);

        $ifEndGroup = $Profile->ifEndGroup($sumMForAllGroup);

        return View('profile.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $request->get('group'))->with('arrayPtk', $Profile->arrayPtk)
            ->with('listGame', $listGame)->with('ifEndGroup', $ifEndGroup)->with('result', $result)->with('listOldGroup', $listOldGroup);
    }

    public function addGameSubmit(Request $request)
    {
        $Profile = new Profile;
        $ProfileRequest = new ProfileRequest;

        $validate = $ProfileRequest->addGame($request);
        if ($validate) {
            return $validate;
        } else {

            $count =$Profile->saveGame($request);
        }

    }

    public function showCountries()
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountryAll();
        $listOldGroup = $Profile->chcekOldGroup();

        return View('profile.showCountries')->with('listCountry', $listCountry)->with('listOldGroup', $listOldGroup);
    }

    public function showCountriesId(int $id)
    {
        $Profile = new Profile;
        $number = $Profile->loadSessionOldGroup();
        $Profile->showCountriesById($id, $number);
        $listOldGroup = $Profile->chcekOldGroup();

        return View('profile.showCountriesId')->with('listGamesGroup', $Profile->listGameGroup)
            ->with('listGamesFriendry', $Profile->listGameFriendry)
            ->with('listGamesCup', $Profile->listGameCup)
            ->with('idCountry', $id)
            ->with('listOldGroup', $listOldGroup);
    }

    public function deleteGroup(int $id)
    {
        $Profile = new Profile;
        $Profile->deleteGroup($id);

        return Redirect::route('profile.showGroup');
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
    public function closeGroup(Request $request)
    {
        $Profile = new Profile;
        $sumMForAllGroup = $Profile->sumMForAllGroup();
        $ifEndGroup = $Profile->ifEndGroup($sumMForAllGroup);
        if ($ifEndGroup == false) {
            return Redirect::route('profile.showGroup', 1)->with('error', 'Nie możesz zakończyć fazy grupowej musisz rozegrac parzystą liczbę meczy');
        }
        else {
             $Profile->closeGroup($request);
        }


    }
    public function showCup()
    {
        $Profile = new Profile;
        $listOldGroup = $Profile->chcekOldGroup();
        $number = $Profile->loadSessionOldGroup();
        $list =  $Profile->showGamesCup($number);

        return View('profile.showCup')->with('list', $list)->with('listOldGroup', $listOldGroup);
    }
    public function changeSeession(Request $request)
    {
        $Profile = new Profile;
        $Profile->putSessionOldGroup($request->get('number'));
        return Redirect::route($request->get('route'));
    }
    public function changeGroup(Request $request)
    {
        $Profile = new Profile;
        $Profile->changeGroup($request);

        return Redirect::back();
    }


}
