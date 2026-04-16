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
    public static function checkGameNullGame(int|null $idCountry)
    {
        return self::where('countrie_id', $idCountry)->first();
    }
    public static function deleteGroup(int $idGroup) {
        self::where('group_id', $idGroup)->delete();
    }
}
