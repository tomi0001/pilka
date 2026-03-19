<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Models\Group;

class Profile
{
    public function showCountry(int $id)
    {
        $Repository = new ProfileRepository;
        $listCountry = $Repository->showCountry($id);

        return $listCountry;
    }

    public function showGroup()
    {
        return Group::showGroup();
    }

    public function ifExistGroup(string $name)
    {

        return Group::ifExistGroup($name);
    }

    public function saveGroup(string $name)
    {
        $Group = new Group;
        $Group->saveGroup($name);
    }
}
