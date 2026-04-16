<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Models\Countrie;
use App\Models\Game;
use App\Models\Group;
use App\Models\Group_forwarding;
use Illuminate\Http\Request;

class Profile
{
    public $arrayPtk = [];

    public $listGameGroup;

    public $listGameFriendry;

    public $listGameCup;

    public function showCountry(int $id)
    {
        $Repository = new ProfileRepository;
        $listCountry = $Repository->showCountry($id);

        $listGame = ProfileRepository::showGames($id);
        if (count($listCountry) > 0) {
            $this->createArrayPtk($listCountry);
        }
        if (count($listGame) > 0) {
            $this->sumPtk($listGame);
            $this->sumGoals();
            array_multisort(array_column($this->arrayPtk, 'PTK'), SORT_DESC, array_column($this->arrayPtk, 'RM'), SORT_ASC, array_column($this->arrayPtk, 'RB'), SORT_DESC, $this->arrayPtk);
        }

        return $listCountry;
    }

    public function showCountryAll()
    {
        return Countrie::showCountries();
    }

    private function createArrayPtk($listCountry)
    {
        for ($i = 0; $i < count($listCountry); $i++) {

            $this->arrayPtk[$i]['name'] = $listCountry[$i]->name;
            $this->arrayPtk[$i]['idCountry'] = $listCountry[$i]->id;
            $this->arrayPtk[$i]['PTK'] = 0;
            $this->arrayPtk[$i]['RM'] = 0;
            $this->arrayPtk[$i]['BZ'] = 0;
            $this->arrayPtk[$i]['BS'] = 0;
            $this->arrayPtk[$i]['RB'] = 0;
            $this->arrayPtk[$i]['W'] = 0;
            $this->arrayPtk[$i]['P'] = 0;
            $this->arrayPtk[$i]['R'] = 0;
        }

    }

    private function sumGoals()
    {
        for ($i = 0; $i < count($this->arrayPtk); $i++) {
            $this->arrayPtk[$i]['RB'] = $this->arrayPtk[$i]['BZ'] - $this->arrayPtk[$i]['BS'];
        }
    }

    private function sumPtk($arrayCountry)
    {
        for ($j = 0; $j < count($this->arrayPtk); $j++) {
            for ($i = 0; $i < count($arrayCountry); $i++) {

                if ($arrayCountry[$i]['country_one'] == $this->arrayPtk[$j]['idCountry']) {

                    if ($arrayCountry[$i]['result_one'] > $arrayCountry[$i]['result_two']) {

                        $this->arrayPtk[$j]['PTK'] += 3;
                        $this->arrayPtk[$j]['W'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_two'];
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_one'];
                    } elseif ($arrayCountry[$i]['result_one'] == $arrayCountry[$i]['result_two']) {
                        $this->arrayPtk[$j]['PTK'] += 1;
                        $this->arrayPtk[$j]['R'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_two'];
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_two'];
                    } else {
                        $this->arrayPtk[$j]['P'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_two'];
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_one'];
                    }

                } elseif ($arrayCountry[$i]['country_two'] == $this->arrayPtk[$j]['idCountry']) {

                    if ($arrayCountry[$i]['result_one'] < $arrayCountry[$i]['result_two']) {

                        $this->arrayPtk[$j]['PTK'] += 3;
                        $this->arrayPtk[$j]['W'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_one'];
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_two'];
                    } elseif ($arrayCountry[$i]['result_one'] == $arrayCountry[$i]['result_two']) {

                        $this->arrayPtk[$j]['PTK'] += 1;
                        $this->arrayPtk[$j]['R'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_two'];
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_two'];
                    } else {
                        $this->arrayPtk[$j]['P'] += 1;
                        $this->arrayPtk[$j]['RM'] += 1;
                        $this->arrayPtk[$j]['BS'] += $arrayCountry[$i]['result_one'];
                        $this->arrayPtk[$j]['BZ'] += $arrayCountry[$i]['result_two'];

                    }
                }

            }
        }

    }

    public function showGroup()
    {
        return Group::showGroup();
    }

    public function ifExistGroup(string $name)
    {

        return Group::ifExistGroup($name);
    }

    public function saveGroup(string $name)
    {
        $Group = new Group;
        $Group->saveGroup($name);
    }

    public function ifExistCountry(string $name)
    {
        return Countrie::ifExistCountry($name);
    }

    public function saveCountry(Request $request)
    {
        $Countrie = new Countrie;
        $id = $Countrie->saveCountry($request->get('name'));

        if ($request->get('group')) {
            $Group_forwarding = new Group_forwarding;
            $Group_forwarding->saveForwarding($id, $request->get('group'));

        }
    }

    public function checkGame(Request $request)
    {
        return ProfileRepository::showGameIfTrue($request->get('countryOne'), $request->get('countryTwo'));

    }

    public function checkGameNullGame(?int $idCountry)
    {
        return Group_forwarding::checkGameNullGame($idCountry);
    }

    public function showGame(int $idGroup)
    {
        return ProfileRepository::showGames($idGroup, true);
    }

    public function saveGame(Request $request)
    {
        $Game = new Game;
        $Game->saveGame($request);
    }

    public function checkGameDate(Request $request)
    {
        return ProfileRepository::showGameIfTrueDate($request->get('countryOne'), $request->get('countryTwo'), $request->get('date').' '.$request->get('time').':00');
    }

    public function showCountriesById(int $id)
    {
        $this->listGameGroup = ProfileRepository::showGamesGroupById($id);
        $this->listGameFriendry = ProfileRepository::showGamesFriendryById($id);
        $this->listGameCup = ProfileRepository::showGamesCupById($id);

    }

    public function deleteGroup(int $id)
    {
        $listGameGroup = ProfileRepository::showGames($id, true);
        if (count($listGameGroup) > 0) {
            return false;
        }
        Group_forwarding::deleteGroup($id);
        Group::destroy($id);

    }
}
