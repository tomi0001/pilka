<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{

    /*
        Created by tomi0001@gmail.com Marz 2026- June 2026
    */
    public $timestamps = false;

    public static function ifExistCountry(string $name)
    {
        return self::where('name', $name)->first();
    }

    public static function showCountries()
    {
        return self::orderBy('name')->get();
    }

    public function saveCountry(string $name): int
    {
        $Countrie = new self;
        $Countrie->name = $name;
        $Countrie->save();

        return $Countrie->id;
    }

    public static function showCountryName(int $idCountry)
    {
        return self::where('id', $idCountry)->first();
    }
}
