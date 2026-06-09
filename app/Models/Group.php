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
}
