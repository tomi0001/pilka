<?php

namespace App\Http\Repositories;

use App\Models\Group;

class ProfileRepository
{
    public function showCountry(int $id)
    {

        $listCountry = Group::join('group_forwardings', 'groups.id', '=', 'group_forwardings.group_id')
            ->join('countries', 'group_forwardings.countrie_id', '=', 'countries.id')->where('groups.id', $id)->get();

        return $listCountry;
    }
}
