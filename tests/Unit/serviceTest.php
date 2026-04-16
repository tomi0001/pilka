<?php

namespace Tests\Unit;

use App\Http\Repositories\ProfileRepository;
use App\Http\Services\Profile;
use App\Models\Countrie;
// use PHPUnit\Framework\TestCase;
// this
use Tests\TestCase;

class ServiceTest extends TestCase
{
    public function test_ptk(): void
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountry(6);

        $this->assertEquals(4, $Profile->arrayPtk[1]['PTK']);
    }

    public function test_goals(): void
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountry(6);

        $this->assertEquals(3, $Profile->arrayPtk[1]['BZ']);
        $this->assertEquals(1, $Profile->arrayPtk[1]['BS']);
        $this->assertEquals(2, $Profile->arrayPtk[1]['RB']);
    }

    public function test_show_name_country(): void
    {
        $Profile = new Profile;
        $listCountry = Countrie::showCountryName(1);

        $this->assertEquals('Polska', $listCountry->name);
    }

    public function test_show_games(): void
    {
        $Profile = new Profile;
        $listGame = $Profile->showGame(6);

        $this->assertEquals(3, count($listGame));
    }

    public function test_show_games_result(): void
    {

        $listGame = ProfileRepository::showGames(6, true);

        $this->assertNotEquals(16, count($listGame));
    }

    public function test_show_games_null_result(): void
    {

        $listGame = ProfileRepository::showGames(6, false);

        $this->assertEquals(1, count($listGame));
    }
}
