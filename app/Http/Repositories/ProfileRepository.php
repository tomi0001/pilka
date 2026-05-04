<?php

namespace App\Http\Repositories;

use App\Models\Countrie;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class ProfileRepository extends Model
{
    public function showCountry(int $id)
    {

        $listCountry = Group::selectRaw('countries.name as name')->selectRaw('countries.id as id')->join('group_forwardings', 'groups.id', '=', 'group_forwardings.group_id')
            ->join('countries', 'group_forwardings.countrie_id', '=', 'countries.id')->where('groups.id', $id)->get();

        return $listCountry;
    }

    public static function showGameIfTrue(?int $idCountryOne, ?int $idCountryTwo)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')->selectRaw(' DISTINCT group_forwardings.group_id')
            ->where(function ($query) use ($idCountryOne, $idCountryTwo) {
                $query->where('group_forwardings.countrie_id', $idCountryOne)
                    ->orWhere('group_forwardings.countrie_id', $idCountryTwo);
            })
            ->get();
    }

    public static function showGames(int $idGroup, bool $isResult = false)
    {
        return Game::join('countries as c1', 'c1.id', '=', 'games.country_one')
            ->join('countries as c2', 'c2.id', '=', 'games.country_two')
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'games.country_one')
            ->join('group_forwardings as gf2', 'gf2.countrie_id', '=', 'games.country_two')
            ->selectRaw('games.id as id')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->selectRaw('games.date as date')->selectRaw('games.country_one as country_one')->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.group_id', $idGroup)
            ->where('games.type', 0)
            ->when($isResult == false, function ($query) {
                $query->whereNotNull('games.result_one')
                    ->whereNotNull('games.result_two');

            })
            ->get();
    }

    public static function showGameIfTrueDate(?int $idCountryOne, ?int $idCountryTwo, string $date)
    {
        return Game::where(function ($query) use ($idCountryOne, $idCountryTwo) {
            $query->where('country_one', $idCountryOne)
                ->Where('country_two', $idCountryTwo);
        })
            ->where('date', $date)
            ->first();
    }

    public static function showNameGroup(int $idCountry)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->join('groups', 'groups.id', '=', 'group_forwardings.group_id')
            ->selectRaw('groups.name as name')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->where('countries.id', $idCountry)->first();
    }

    public static function countGames(int $idCountry)
    {
        return Game::where('country_one', $idCountry)->orWhere('country_two', $idCountry)->count();
    }

    public static function showGamesGroupById(int $id)
    {
        return Game::join('countries', function ($join) {
            $join->on('countries.id', '=', 'games.country_one')
                ->orOn('countries.id', '=', 'games.country_two');
        })
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.countrie_id', $id)
            ->where('games.type', 0)
            ->get();
    }

    public static function showGamesFriendryById(int $id)
    {
        return Game::join('countries', function ($join) {
            $join->on('countries.id', '=', 'games.country_one')
                ->orOn('countries.id', '=', 'games.country_two');
        })
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.countrie_id', $id)
            ->where('games.type', 2)
            ->get();
    }

    public static function showGamesCupById(int $id)
    {
        return Game::join('countries as c1', 'c1.id', '=', 'games.country_one')
            ->join('countries as c2', 'c2.id', '=', 'games.country_two')
            ->join('group_forwardings', 'group_forwardings.countrie_id', '=', 'games.country_one')
            ->join('group_forwardings as gf2', 'gf2.countrie_id', '=', 'games.country_two')
            ->selectRaw('group_forwardings.group_id as group_id')
            ->selectRaw('games.type as type')
            ->selectRaw('games.date as date')
            ->selectRaw('games.id as id')
            ->selectRaw('games.country_one as country_one')
            ->selectRaw('games.country_two as country_two')
            ->selectRaw('games.result_one as result_one')
            ->selectRaw('games.result_two as result_two')
            ->where('group_forwardings.countrie_id', $id)
            ->where('games.type', 1)
            ->get();
    }
}
