<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    public $timestamps = false;

    public static function ifExistCountry(string $name)
    {
        return self::where('name', $name)->first();
    }

    public static function showCountries()
    {
        return self::all();
    }

    public function saveCountry(string $name): int
    {
        $Countrie = new self;
        $Countrie->name = $name;
        $Countrie->save();

        return $Countrie->id;
    }


}
