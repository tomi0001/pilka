<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Models\Countrie;
use App\Models\Group;
use App\Models\Group_forwarding;
use Illuminate\Http\Request;

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

    public function ifExistCountry(string $name)
    {
        return Countrie::ifExistCountry($name);
    }

    public function saveCountry(Request $request)
    {
        $Countrie = new Countrie;
        $id = $Countrie->saveCountry($request->get('name'));

        if ($request->get('group')) {
            $Group_forwarding = new Group_forwarding;
            $Group_forwarding->saveForwarding($id, $request->get('group'));

        }
    }
}
