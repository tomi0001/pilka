<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Game extends Model
{
    public $timestamps = false;

    public static function showGames(int $id)
    {
        return self::join('group_forwardings', 'group_forwardings.group_id', '=', 'group_forwardings.countrie_id')
            ->where('group_forwardings.group_id', $id)->orderBy('date')->get();

    }

    public static function showGamesTwo(int $idCountry)
    {
        return self::where('country_one', $idCountry)->orWhere('country_two', $idCountry)->get();

    }

    public function saveGame(Request $request)
    {
        $this->country_one = $request->get('countryOne');
        $this->country_two = $request->get('countryTwo');
        $this->date = $request->get('date').' '.$request->get('time').':00';
        $this->result_one = $request->get('resultOne');
        $this->result_two = $request->get('resultTwo');
        $this->result_over_one = $request->get('result_over_one');
        $this->result_over_two = $request->get('result_over_two');
        $this->result_pena_one = $request->get('result_pena_one');
        $this->result_pena_two = $request->get('result_pena_two');
        $this->status = $request->get('type');
        $this->save();
    }
    public static function showGameById(int $id)
    {
        return self::selectRaw("result_one as result_one")->selectRaw("result_two as result_two")
        ->selectRaw("country_one as country_one")->selectRaw("country_two as country_two")
        ->selectRaw("date as date")->selectRaw("id as id")->where('id', $id)
        ->first();

    }
    public function editGame(Request $request, int $id)
    {
        $Game = self::find($id);
        $Game->date = $request->get('date').' '.$request->get('time').':00';
        $Game->result_one = $request->get('resultOne');
        $Game->result_two = $request->get('resultTwo');
        $Game->save();
    }
    public static function checkIfFirstCup(int $cup, bool $isResult = false) {
        return self::where('status', $cup)->where('type', 0)
            ->when($isResult == true, function ($query) {
                $query->whereNotNull('games.result_one')
                    ->whereNotNull('games.result_two');

            })
        ->count();
    }
    public static function checkCountryIfGameExist(int $idCountry,int $status) {
        return self::where(function ($query) use ($idCountry) {
            $query->where('country_one', $idCountry)
                ->orWhere('country_two', $idCountry);
        })
        ->where('status', $status)
        ->where('type', 0)
        ->count();
    }

}
