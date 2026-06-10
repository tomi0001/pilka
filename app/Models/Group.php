<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    public static function showGroup(int $number = 0)
    {
        return self::where('type', $number)->orderBy('name')->get();
    }

    public static function ifExistGroup(string $name)
    {
        return self::where('name', $name)->where('type', 0)->first();
    }

    public function saveGroup(string $name)
    {
        $Group = new self;
        $Group->name = strtoupper($name);
        $Group->save();
    }

    public static function countGroups(int $number = 0)
    {
        return self::where('type', $number)->count();
    }

    public function increments()
    {
        return self::increment('type');
    }

    public static function whereIdFirstGroup(int $number = 0)
    {
        return self::where('type', $number)->first();
    }

    public static function chcekOldGroup()
    {
        return self::selectRaw('type as type')->where('type', '>', 0)->groupBy('type')->get();
    }
    public function showCountry(int $id, int $number = 0)
    {

        $listCountry = self::selectRaw('countries.name as name')->selectRaw('countries.id as id')->join('group_forwardings', 'groups.id', '=', 'group_forwardings.group_id')
            ->join('countries', 'group_forwardings.countrie_id', '=', 'countries.id')->where('groups.id', $id)->where('groups.type', $number)->get();

        return $listCountry;
    }

    public function showCountryForM()
    {

        $listCountry = self::selectRaw('countries.name as name')->selectRaw('countries.id as id')->join('group_forwardings', 'groups.id', '=', 'group_forwardings.group_id')
            ->join('countries', 'group_forwardings.countrie_id', '=', 'countries.id')->get();

        return $listCountry;
    }
}
