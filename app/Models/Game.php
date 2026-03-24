<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public static function showGames(int $id)
    {
        return self::join('group_forwardings', 'group_forwardings.group_id', '=', 'group_forwardings.countrie_id')
            ->where('group_forwardings.group_id', $id)->get();

    }

    public static function showGamesTwo(int $idCountry)
    {
        return self::where('country_one', $idCountry)->orWhere('country_two', $idCountry)->get();

    }
}
