<?php

namespace App\Http\Repositories;

use App\Models\Countrie;
use App\Models\Game;
use App\Models\Group;
use App\Models\Group_forwarding;
use Illuminate\Database\Eloquent\Model;

class ProfileRepository extends Model
{


    /*
        Created by tomi0001@gmail.com Marz 2026- June 2026
    */

    public static function showGameIfTrue1(int $idCountryOne, int $idCountryTwo)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')->selectRaw(' DISTINCT group_forwardings.group_id')
            ->where('type', 0)
            ->where(function ($query) use ($idCountryOne, $idCountryTwo) {
                $query->where('group_forwardings.countrie_id', $idCountryOne)
                    ->orWhere('group_forwardings.countrie_id', $idCountryTwo);
            })
            ->get();
    }

    public static function showGameIfTrue(int $idCountry)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')->selectRaw(' DISTINCT group_forwardings.group_id as groupId')
            ->where('type', 0)

            ->where('group_forwardings.countrie_id', $idCountry)

            ->first();
    }

    public static function showGames(int $idGroup, int $number = 0, bool $isResult = false)
    {
        return Game::join('countries as c1', 'c1.id', '=', 'games.country_one')
            ->join('countries as c2', 'c2.id', '=', 'games.country_two')
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'games.country_one')

            ->selectRaw('games.id as id')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->selectRaw('games.date as date')->selectRaw('games.country_one as country_one')->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.group_id', $idGroup)
            ->where('games.type', $number)
            ->where('games.status', -1)
            ->when($isResult == false, function ($query) {
                $query->whereNotNull('games.result_one')
                    ->whereNotNull('games.result_two');

            })
            ->orderBy('date')
            ->get();
    }

    public static function showGameIfTrueDate(int $idCountryOne, int $idCountryTwo, string $date)
    {
        return Game::where(function ($query) use ($idCountryOne, $idCountryTwo) {
            $query->where('country_one', $idCountryOne)
                ->Where('country_two', $idCountryTwo);
        })
            ->where('date', $date)
            ->where('type', 0)
            ->first();
    }

    public static function showGameIfTrueDateIsEdit(int $idCountryOne, int $idCountryTwo, string $date)
    {
        return Game::where(function ($query) use ($idCountryOne, $idCountryTwo) {
            $query->where('country_one', $idCountryOne)
                ->Where('country_two', $idCountryTwo);
        })
            ->whereNotNull('games.result_one')
            ->whereNotNull('games.result_two')

            ->where('date', $date)
            ->where('type', 0)
            ->first();
    }

    public static function showNameGroup(int $idCountry, ?int $number = 0)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->join('groups', 'groups.id', '=', 'group_forwardings.group_id')
            ->selectRaw('groups.name as name')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->where('countries.id', $idCountry)
            ->where('groups.type', $number)
            ->first();
    }

    public static function countGames(int $idCountry, ?int $number = 0)
    {
        return Game::where(function ($query) use ($idCountry) {
            $query->where('country_one', $idCountry)
                ->orWhere('country_two', $idCountry);
        })
            ->where('type', $number)
            ->count();
    }

    public static function showGamesGroupById(int $id, int $number = 0)
    {
        return Game::join('countries', function ($join) {
            $join->on('countries.id', '=', 'games.country_one')
                ->orOn('countries.id', '=', 'games.country_two');
        })
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->selectRaw('distinct group_forwardings.countrie_id as countrie_id')
            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.countrie_id', $id)
            ->where('games.type', $number)
            ->where('games.status', -1)
            ->get();
    }

    public static function showGamesFriendryById(int $id, int $number = 0)
    {
        return Game::join('countries', function ($join) {
            $join->on('countries.id', '=', 'games.country_one')
                ->orOn('countries.id', '=', 'games.country_two');
        })

            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->where('countries.id', $id)
            ->where('games.type', $number)
            ->where('games.status', -2)
            ->get();
    }

    public static function showGamesCupById(int $id, int $number = 0)
    {
        return Game::join('countries', function ($join) {
            $join->on('countries.id', '=', 'games.country_one')
                ->orOn('countries.id', '=', 'games.country_two');
        })
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->selectRaw('distinct group_forwardings.countrie_id as countrie_id')
            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.status as status')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->selectRaw('games.result_over_one as result_over_one')
            ->selectRaw('games.result_over_two as result_over_two')
            ->selectRaw('games.result_pena_one as result_pena_one')
            ->selectRaw('games.result_pena_two as result_pena_two')
            ->where('group_forwardings.countrie_id', $id)
            ->where('games.type', $number)
            ->where('games.status', '>=', 0)
            ->get();
    }







    public static function checkGameForCloseGroup(int $idCountryOne)
    {
        return Group_forwarding::join('groups', 'group_forwardings.group_id', 'groups.id')
            ->where('groups.type', 0)
            ->where(function ($query) use ($idCountryOne) {
                $query->where('group_forwardings.countrie_id', $idCountryOne);
            })
            ->first();
    }
    public static function chcekIfGameExistCup(int $idCountryOne, int $idCountryTwo, int $status)
    {
        return Game::where('status', $status)
            ->where('type', 0)
            ->where(function ($query) use ($idCountryOne, $idCountryTwo) {
                $query->where(function ($q) use ($idCountryOne, $idCountryTwo) {
                    $q->where('country_one', $idCountryOne)
                    ->where('country_two', $idCountryTwo);
                })->orWhere(function ($q) use ($idCountryOne, $idCountryTwo) {
                    $q->where('country_one', $idCountryTwo)
                    ->where('country_two', $idCountryOne);
                });
            })
            ->count();
    }
    public static function checkIfFirstCup(int $cup, bool $isResult = false)
    {
        return Game::where('status', $cup)->where('type', 0)
            ->when($isResult == true, function ($query) {
                $query->whereNotNull('games.result_one')
                    ->whereNotNull('games.result_two');

            })
            ->count();
    }

    public static function checkCountryIfGameExist(int $idCountry, int $status)
    {
        return Game::where(function ($query) use ($idCountry) {
            $query->where('country_one', $idCountry)
                ->orWhere('country_two', $idCountry);
        })
            ->where('status', $status)
            ->whereNotNull('result_one')
            ->where('type', 0)
            ->count();
    }
}
