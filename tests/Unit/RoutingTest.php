<?php

namespace Tests\Unit;

use App\Http\Services\Profile;
// use PHPUnit\Framework\TestCase;
use App\Models\Group; // this
use App\Models\User;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test(): void
    {
        // $user = new Profile();
        // $this->assertEquals('Jan Kowalski', $user->showGroup());
        // $this->assertRedirect('/login');
        // $user = Group::factory()->create();
        $user = User::find(4);

        $response = $this->actingAs($user)->get('/profile.addGroup');
        $response = $this->get('/profile.addGroup');

        $response->assertStatus(200);
        // $response->assertViewHas('user', $user); // Sprawdza, czy zmienna 'user' została przekazana
        // $response->assertViewHas('title', 'Profil użytkownika');
    }

    public function testShowGroup(): void
    {
        $Profile = new Profile;
        $listGroup = $Profile->showGroup();

        $this->assertNotEmpty($listGroup);
    }
    public function testShowCountry(): void
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountry(6);

        $this->assertNotEmpty($listCountry);
    }
}
