<?php

namespace App\Http\Controllers;

use App\Http\Services\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuestController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            Redirect::route('dashboard')->send();
        }
    }



    public function showGroup()
    {
        $Profile = new Profile;
        $number = $Profile->loadSessionOldGroup();
        $listGroup = $Profile->showGroup($number);
        $result = $Profile->calculateCup($number);
        $listOldGroup = $Profile->chcekOldGroup();

        if (count($listGroup) == 0) {
            return View('guest.showGroupError')->with('listOldGroup', $listOldGroup);
        }
        $id = $Profile->whereIdFirstGroup($number);
        $listCountry = $Profile->showCountry($id, $number);
        $listGame = $Profile->showGame($id, $number);
        if (count($listCountry) == 0) {
            return View('guest.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
                ->with('selectedGroup', $id)->with('result', $result)->with('ifEndGroup', false)->with('listGame', $listGame)->with('listOldGroup', $listOldGroup);
        }

        $sumMForAllGroup = $Profile->sumMForAllGroup($number);
        $ifEndGroup = $Profile->ifEndGroup($sumMForAllGroup);

        return View('guest.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $id)->with('listGame', $listGame)->with('arrayPtk', $Profile->arrayPtk)
            ->with('ifEndGroup', $ifEndGroup)->with('result', $result)->with('listOldGroup', $listOldGroup);
    }

    public function showGroupForm(Request $request)
    {
        $Profile = new Profile;
        $number = $Profile->loadSessionOldGroup();
        $listGroup = $Profile->showGroup($number);
        $listOldGroup = $Profile->chcekOldGroup();

        if (count($listGroup) == 0) {
            return View('guest.showGroupError')->with('listOldGroup', $listOldGroup);
        }
        $listCountry = $Profile->showCountry($request->get('group'), $number);
        $result = $Profile->calculateCup($number);

        $listGame = $Profile->showGame($request->get('group'), $number);
        if (count($listCountry) == 0) {
            return View('guest.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
                ->with('selectedGroup', $request->get('group'))->with('result', $result)->with('ifEndGroup', false)
                ->with('listGame', $listGame)->with('listOldGroup', $listOldGroup);
        }

        $sumMForAllGroup = $Profile->sumMForAllGroup($number);
        $ifEndGroup = $Profile->ifEndGroup($sumMForAllGroup);

        return View('guest.showGroup')->with('listGroup', $listGroup)->with('listCountry', $listCountry)
            ->with('selectedGroup', $request->get('group'))->with('arrayPtk', $Profile->arrayPtk)
            ->with('listGame', $listGame)->with('ifEndGroup', $ifEndGroup)->with('result', $result)->with('listOldGroup', $listOldGroup);
    }

    public function showCountries()
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountryAll();
        $listOldGroup = $Profile->chcekOldGroup();

        return View('guest.showCountries')->with('listCountry', $listCountry)->with('listOldGroup', $listOldGroup);
    }

    public function showCountriesId(int $id)
    {
        $Profile = new Profile;
        $number = $Profile->loadSessionOldGroup();
        $Profile->showCountriesById($id, $number);
        $listOldGroup = $Profile->chcekOldGroup();

        return View('guest.showCountriesId')->with('listGamesGroup', $Profile->listGameGroup)
            ->with('listGamesFriendry', $Profile->listGameFriendry)
            ->with('listGamesCup', $Profile->listGameCup)
            ->with('idCountry', $id)
            ->with('listOldGroup', $listOldGroup);
    }

    public function showCup()
    {
        $Profile = new Profile;
        $listOldGroup = $Profile->chcekOldGroup();
        $number = $Profile->loadSessionOldGroup();
        $list = $Profile->showGamesCup($number);

        return View('guest.showCup')->with('list', $list)->with('listOldGroup', $listOldGroup);
    }

    public function changeSeession(Request $request)
    {
        $Profile = new Profile;
        $Profile->putSessionOldGroup($request->get('number'));

        return Redirect::route($request->get('route'));
    }
}
