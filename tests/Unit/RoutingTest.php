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

        $user = User::find(1);

        $response = $this->actingAs($user)->get('/profile.addGroup');
        $response = $this->get('/profile.addGroup');

        $response->assertStatus(200);

    }

    public function test_show_group(): void
    {
        $Profile = new Profile;
        $listGroup = $Profile->showGroup();

        $this->assertNotEmpty($listGroup);
    }

    public function test_show_country(): void
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountry(4);

        $this->assertNotEmpty($listCountry);
    }
}
