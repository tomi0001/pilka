<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    public static function showGroup()
    {
        return self::all();
    }

    public static function ifExistGroup(string $name)
    {
        return self::where('name', $name)->first();
    }

    public function saveGroup(string $name)
    {
        $Group = new self;
        $Group->name = $name;
        $Group->save();
    }
}
