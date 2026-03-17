<?php

namespace Tests\Unit;
use App\Http\Services\Profile;
use Mockery;
use Mockery\MockInterface;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //this
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Group;
use App\Models\User;
class RoutingTest extends TestCase
{

    /**
     * A basic unit test example.
     */
    public function test(): void
    {
        //$user = new Profile();
        //$this->assertEquals('Jan Kowalski', $user->showGroup());
        //$this->assertRedirect('/login');
        //$user = Group::factory()->create();
        $user = User::find(4);

        $response = $this->actingAs($user)->get('/profile.addGroup');
        $response = $this->get('/profile.addGroup');

        $response->assertStatus(200);
        // $response->assertViewHas('user', $user); // Sprawdza, czy zmienna 'user' została przekazana
        // $response->assertViewHas('title', 'Profil użytkownika');
    }
}
