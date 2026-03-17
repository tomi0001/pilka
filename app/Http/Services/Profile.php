<?php

namespace App\Http\Services;
use App\Models\Group;

class Profile
{
    public function showGroup()
    {
        //return Group::showGroup();
        $a = array(1, 2, 3, 4);
        return $a;
    }
    public function ifExistGroup(string $name)
    {

        return Group::ifExistGroup($name);
    }
    public function saveGroup(string $name)
    {
        $Group = new Group();
        $Group->saveGroup($name);
    }

}