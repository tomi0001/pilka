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
            ->where('group_forwardings.group_id', $id)->orderBy("date")->get();

    }

    public static function showGamesTwo(int $idCountry)
    {
        return self::where('country_one', $idCountry)->orWhere('country_two', $idCountry)->get();

    }
    public function saveGame(Request $request)
    {
        $this->country_one = $request->get('countryOne');
        $this->country_two = $request->get('countryTwo');
        $this->date = $request->get('date') .  " " . $request->get('time') . ":00";
        $this->result_one = $request->get('resultOne');
        $this->result_two = $request->get('resultTwo');
        $this->type = $request->get('type');
        $this->save();
    }

}
