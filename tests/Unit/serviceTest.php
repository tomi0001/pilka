<?php

namespace Tests\Unit;

use App\Http\Services\Profile;
// use PHPUnit\Framework\TestCase;
// this
use Tests\TestCase;

class ServiceTest extends TestCase
{
    public function test_ptk(): void
    {
        $Profile = new Profile;
        $listCountry = $Profile->showCountry(6);

        $this->assertEquals(4, $Profile->arrayPtk2[1]['PTK']);
    }
}
