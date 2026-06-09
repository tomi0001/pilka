<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_forwarding extends Model
{
    public $timestamps = false;

    public function saveForwarding(int $idCountry, int $idGroup)
    {
        $Group_forwarding = new self;
        $Group_forwarding->countrie_id = $idCountry;
        $Group_forwarding->group_id = $idGroup;
        $Group_forwarding->save();
    }

    public static function checkGameNullGame(int $idCountry)
    {
        return self::where('countrie_id', $idCountry)->first();
    }

    public static function deleteGroup(int $idGroup)
    {
        self::where('group_id', $idGroup)->delete();
    }

    public static function deleteCountry(int $idCountry)
    {
        self::where('countrie_id', $idCountry)->delete();
    }

    public function increments()
    {
        return self::increment('type');
    }

    public static function checkForwarding(int $idCountry)
    {
        return self::selectRaw('group_id as group_id')->where('countrie_id', $idCountry)->where('type', 0)->first();
    }

    public function deleteForwarding(int $idCountry)
    {
        $Group_forwarding = new self;
        $Group_forwarding->where('countrie_id', $idCountry)->where('type', 0)->delete();
    }
}
