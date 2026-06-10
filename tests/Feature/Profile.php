<?php

use App\Http\Services\Profile as ProfileService;


test('Show Country All', function () {
    $Profile = new ProfileService;
    $array = $Profile->showCountryAll();
    expect($array)->toBeObject();


});
test('calculate cup', function () {
    $Profile = new ProfileService;
    $array = $Profile->calculateCup();
    expect($array)->toBeArray();
    expect($array)->toHaveCount(2);


});

