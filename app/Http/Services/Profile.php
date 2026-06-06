<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Models\Countrie;
use App\Models\Game;
use App\Models\User;
use App\Models\Group;
use App\Models\Group_forwarding;
use Auth;
use Illuminate\Http\Request;

class Profile
{
    public $arrayPtk = [];

    public $listGameGroup;

    public $listGameFriendry;

    public $listGameCup;
    public $listStatusErrorForCloseGroup = false;
    public $listStatusErrorFirstCup = true;
    public $listStatusErrorGamesCup = false;
    public $listStatusErrorCountryIfGameExist = false;
    public $listStatusChcekIfGameExistCup = false;


    public function showCountry(int $id, int $number = 0)
    {
        $Repository = new ProfileRepository;
        $listCountry = $Repository->showCountry($id, $number);

        $listGame = ProfileRepository::showGames($id, $number);
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

    private function crecreateArrayForM($listCountry)
    {
        for ($i = 0; $i < count($listCountry); $i++) {

            //$arrayPtk[$i]['idGroup'] = $listCountry[$i]->idGroup;
            $arrayPtk[$i]['idCountry'] = $listCountry[$i]->id;
            $arrayPtk[$i]['RM'] = 0;

        }

        return $arrayPtk;

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

    private function sumPtkForM($listGame, $arrayPtk)
    {
        for ($j = 0; $j < count($arrayPtk); $j++) {
            for ($i = 0; $i < count($listGame); $i++) {

                if ($listGame[$i]['country_one'] == $arrayPtk[$j]['idCountry']) {
                    $arrayPtk[$j]['RM'] += 1;

                } elseif ($listGame[$i]['country_two'] == $arrayPtk[$j]['idCountry']) {
                    $arrayPtk[$j]['RM'] += 1;
                }

            }
        }

        return $arrayPtk;
    }

    private function sumPtk($listGame)
    {
        for ($j = 0; $j < count($this->arrayPtk); $j++) {
            for ($i = 0; $i < count($listGame); $i++) {

                if ($listGame[$i]['country_one'] == $this->arrayPtk[$j]['idCountry']) {

                    $this->sumPtkForCountryOne($listGame, $j, $i);

                } elseif ($listGame[$i]['country_two'] == $this->arrayPtk[$j]['idCountry']) {

                    $this->sumPtkForCountryTwo($listGame, $j, $i);
                }

            }
        }

    }

    private function sumPtkForCountryOne($listGame, int $j, int $i)
    {
        if ($listGame[$i]['result_one'] > $listGame[$i]['result_two']) {

            $this->arrayPtk[$j]['PTK'] += 3;
            $this->arrayPtk[$j]['W'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_two'];
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_one'];
        } elseif ($listGame[$i]['result_one'] == $listGame[$i]['result_two']) {
            $this->arrayPtk[$j]['PTK'] += 1;
            $this->arrayPtk[$j]['R'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_two'];
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_two'];
        } else {
            $this->arrayPtk[$j]['P'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_two'];
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_one'];
        }

    }

    private function sumPtkForCountryTwo($listGame, int $j, int $i)
    {
        if ($listGame[$i]['result_one'] < $listGame[$i]['result_two']) {

            $this->arrayPtk[$j]['PTK'] += 3;
            $this->arrayPtk[$j]['W'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_one'];
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_two'];
        } elseif ($listGame[$i]['result_one'] == $listGame[$i]['result_two']) {

            $this->arrayPtk[$j]['PTK'] += 1;
            $this->arrayPtk[$j]['R'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_two'];
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_two'];
        } else {
            $this->arrayPtk[$j]['P'] += 1;
            $this->arrayPtk[$j]['RM'] += 1;
            $this->arrayPtk[$j]['BS'] += $listGame[$i]['result_one'];
            $this->arrayPtk[$j]['BZ'] += $listGame[$i]['result_two'];

        }

    }

    public function showGroup(int $number = 0)
    {
        return Group::showGroup($number);


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
        $idOne = ProfileRepository::showGameIfTrue($request->get('countryOne'));
        $idTwo = ProfileRepository::showGameIfTrue($request->get('countryTwo'));
        if (empty($idOne) || empty($idTwo)) {
            return false;
        }
        if ($idOne->groupId == $idTwo->groupId) {
            return true;
        }
        return false;

    }

    public function checkGameNullGame(int $idCountry)
    {
        return Group_forwarding::checkGameNullGame($idCountry);
    }

    public function showGame(int $idGroup,int $number = 0)
    {
        return ProfileRepository::showGames($idGroup,$number, true);
    }

    public function saveGame(Request $request)
    {
        $Game = new Game;
        $Game->saveGame($request);
        if (  (Auth::user()->status == 1 and $request->get('status') == 0) )  {
            $count = Game::checkIfFirstCup(0,true);
        }
        else {
            $count = Game::checkIfFirstCup(Auth::user()->status,true);
        }
        if ($count >= Auth::user()->status) {
            $User = new User;
            if ( ( Auth::user()->status == 0 )  or (Auth::user()->status == 1 and $request->get('status') == 0) )  {
                $Group = new Group;
                $Group_forwarding = new Group_forwarding;
                $Game = new Game;
                $Group->increments();
                $Game->increments();
                $Group_forwarding->increments();
                $User->changeStatus(-1);
            }
            elseif (Auth::user()->status == 1 and $request->get('status') == 0) {
                $User->changeStatus(1);
            }
            elseif (Auth::user()->status == 1) {
                $User->changeStatus(0);
            }
            elseif (Auth::user()->status >= 0) {
                $User->changeStatus(Auth::user()->status / 2);
            }

        }
    }

    public function checkGameDate(Request $request, bool $isEdit = false)
    {
        if ($isEdit) {
            return ProfileRepository::showGameIfTrueDateIsEdit($request->get('countryOne'), $request->get('countryTwo'), $request->get('date').' '.$request->get('time').':00');
        }
        else {

            return ProfileRepository::showGameIfTrueDate($request->get('countryOne'), $request->get('countryTwo'), $request->get('date').' '.$request->get('time').':00');
        }
    }

    public function showCountriesById(int $id,  int $number = 0)
    {
        $this->listGameGroup = ProfileRepository::showGamesGroupById($id, $number);
        $this->listGameFriendry = ProfileRepository::showGamesFriendryById($id, $number);
        $this->listGameCup = ProfileRepository::showGamesCupById($id, $number);

    }

    public function deleteGroup(int $id)
    {
        $listGameGroup = ProfileRepository::showGames($id, true);
        if (count($listGameGroup) > 0) {
            return false;
        }
        Group_forwarding::deleteGroup($id);
        Group::destroy($id);

        return true;

    }

    public function deleteCountry(int $id)
    {
        $this->listGameGroup = ProfileRepository::showGamesGroupById($id);
        $this->listGameFriendry = ProfileRepository::showGamesFriendryById($id);
        $this->listGameCup = ProfileRepository::showGamesCupById($id);
        if (count($this->listGameGroup) > 0 and count($this->listGameFriendry) > 0 and count($this->listGameCup) > 0) {
            return false;
        }
        Group_forwarding::deleteCountry($id);
        Countrie::destroy($id);

    }

    public function deleteGame(int $id)
    {
        Game::destroy($id);
    }

    public function showGameById(int $id)
    {
        return Game::showGameById($id);
    }

    public function editGame(Request $request, int $id)
    {
        $Game = new Game;
        $Game->editGame($request, $id);
        $gameId = $this->showGameId($id);
        if (  (Auth::user()->status == 1 and $gameId->status == 0) )  {
            $count = Game::checkIfFirstCup(0,true);
        }
        else {
            $count = Game::checkIfFirstCup(Auth::user()->status,true);
        }
        if ($count >= Auth::user()->status) {
            $User = new User;
            if ( ( Auth::user()->status == 0 )  or (Auth::user()->status == 1 and $gameId->status == 0) )  {
                $Group = new Group;
                $Group_forwarding = new Group_forwarding;
                $Game = new Game;
                $Group->increments();
                $Game->increments();
                $Group_forwarding->increments();
                $User->changeStatus(-1);
            }
            elseif (Auth::user()->status == 1 and $gameId->status == 0) {
                $User->changeStatus(1);
            }
            elseif (Auth::user()->status == 1) {
                $User->changeStatus(0);
            }
            elseif (Auth::user()->status >= 0) {
                $User->changeStatus(Auth::user()->status / 2);
            }

        }
    }

    public function sumMForAllGroup(int $number = 0)
    {
        $Repository = new ProfileRepository;
        $listGroup = Group::showGroup($number);
        $i = 0;
        foreach ($listGroup as $group) {
            $listCountry = $Repository->showCountry($group->id, $number);
            if (count($listCountry) > 0) {
                $arrayPtk[] = $this->crecreateArrayForM($listCountry);
                //$i++;
            }
            $listGame = ProfileRepository::showGames($group->id,$number);
            if (count($listGame) > 0) {
                $arrayPtk[] = $this->sumPtkForM($listGame, $arrayPtk[$i]);
            }

        }

        return $arrayPtk;
    }

    public function ifEndGroup($sumMForAllGroup)
    {
        $howM = 0;
        for ($i = 0; $i < count($sumMForAllGroup); $i++) {
            for ($j = 0; $j < count($sumMForAllGroup[$i]); $j++) {
                if ($i == 0 and $j == 0 and $sumMForAllGroup[$i][$j]['RM'] > 0) {
                    $howM = $sumMForAllGroup[$i][$j]['RM'];
                } elseif ($sumMForAllGroup[$i][$j]['RM'] == 0 or $sumMForAllGroup[$i][$j]['RM'] != $howM) {
                    return false;
                }

            }
        }

        return true;
    }
    public function calculateCup(int $number = 0)
    {

        $Repository = new ProfileRepository;
        $number = $this->loadSessionOldGroup();
        $result = $Repository->calculateCup($number);
        $countGroups = Group::countGroups($number);
        $lowerLimit = $this->calculateCupLower($countGroups);
        $upperLimit = $this->calculateCupUpper($result);

        if ($lowerLimit > $upperLimit) {

            $lowerLimit = $upperLimit;
        }
        return [$lowerLimit, $upperLimit];

    }

    private function calculateCupLower(int $countGroups) {
        $lowerLimit = 2;
        $count = $countGroups;
        while ($count > $lowerLimit) {
            if ($lowerLimit > 65) {
                break;
            }
            $lowerLimit = $lowerLimit * 2;
        }
        return (int) $lowerLimit / 2;
}

    private function calculateCupUpper(int $countCountry) {
        $upperLimit = 64;
        $count = $countCountry / 2;
        while ($count < $upperLimit) {
            $upperLimit = $upperLimit / 2;
        }
        return (int) $upperLimit;
    }
    public function closeGroup(Request $request) {
        $User = new User;
        $User->changeStatus($request->get('closeGroup'));

    }
    public function chcekErrorCup(int $idCountryOne, int $idCountryTwo = 0) {
            $this->listStatusErrorFirstCup = true;
            $this->listStatusErrorForCloseGroup = false;
            $this->listStatusErrorGamesCup = false;
            $this->listStatusErrorCountryIfGameExist = false;
            $this->listStatusChcekIfGameExistCup = false;

            $this->checkGameForCloseGroup($idCountryOne);
            $this->checkIfFirstCup($idCountryOne);
            $this->countGamesCup(Auth::user()->status);
            $this->checkCountryIfGameExist($idCountryOne);
            $this->chcekIfGameExistCup($idCountryTwo,$idCountryOne);

    }
    private function checkGameForCloseGroup(int $idCountryOne) {
        $tmp =  ProfileRepository::checkGameForCloseGroup($idCountryOne);
        if ($tmp == true) {
            $this->listStatusErrorForCloseGroup = true;
        }
    }
    private function checkIfFirstCup(int $idCountry) {
        if (Auth::user()->status == 0 or Auth::user()->status == 1) {
            $tmp = 2;
        }
        else {
            $tmp = Auth::user()->status * 2;
        }
        $count = Game::checkIfFirstCup($tmp);
        if ($count != 0) {
            $count = Game::checkCountryIfGameExist($idCountry, $tmp);
            if ($count == 0) {
                $this->listStatusErrorFirstCup = false;
            }

        }
    }
    private function chcekIfGameExistCup(int $idCountryOne, int $idCountryTwo) {
        if (Auth::user()->status == 0 or Auth::user()->status == 1) {
            $tmp = 2;
        }
        else {
            $tmp = Auth::user()->status * 2;
        }
        $count = Game::chcekIfGameExistCup($idCountryOne,$idCountryTwo, $tmp);
        if ($count == 0) {
            $this->listStatusChcekIfGameExistCup = true;
        }
    }
    private function countGamesCup(int $status) {
        if (Auth::user()->status == 0 or Auth::user()->status == 1) {
            $this->listStatusErrorGamesCup = true;
            return;
        }
        $count = Game::checkIfFirstCup($status);
        if ($count < $status) {
            $this->listStatusErrorGamesCup = true;
        }
    }
    private function checkCountryIfGameExist(int $idCountry) {
        $tmp = Auth::user()->status;
        $count = Game::checkCountryIfGameExist($idCountry, $tmp);
        if ($count == 0) {
            return $this->listStatusErrorCountryIfGameExist = true;
        }
    }
    public function showGamesCup(int $number = 0) {
        return Game::showGamesCup($number);
    }
    public function whereIdFirstGroup(int $number = 0) {
        return Group::whereIdFirstGroup($number)->id;
    }
    public function chcekOldGroup() {

        return Group::chcekOldGroup();

    }
    public function loadSessionOldGroup() :int {
        if (session()->has('oldGroup')) {
            return session()->get('oldGroup');
        }
        session()->put('oldGroup', 0);
        return session()->get('oldGroup');
    }
    public function changeGroup(Request $request)
    {

        $Group_forwarding = new Group_forwarding;
        $Group_forwarding->deleteForwarding($request->get('idCountry'));
        if ($request->get('groupChange') != 0) {
            $Group_forwarding = new Group_forwarding;
            $Group_forwarding->saveForwarding($request->get('idCountry'), $request->get('groupChange'));
        }


    }
    public function putSessionOldGroup(int|null $number) {
         session()->put('oldGroup', $number);
    }
    public function showGameId(int $id) {
        return Game::showGameById($id);
    }

}
