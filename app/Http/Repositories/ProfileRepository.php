<?php

namespace App\Http\Repositories;

use App\Models\Group;
use App\Models\Countrie;
use Illuminate\Database\Eloquent\Model;

class ProfileRepository extends Model
{
    public function showCountry(int $id)
    {

        $listCountry = Group::selectRaw('countries.name as name')->selectRaw('countries.id as id')->join('group_forwardings', 'groups.id', '=', 'group_forwardings.group_id')
            ->join('countries', 'group_forwardings.countrie_id', '=', 'countries.id')->where('groups.id', $id)->get();

        return $listCountry;
    }

    public static function showGameIfTrue(int $idCountryOne, int $idCountryTwo)
    {
        return Countrie::join('group_forwardings', 'group_forwardings.countrie_id', '=', 'countries.id')->selectRaw(' DISTINCT group_forwardings.group_id')
            ->where(function ($query) use ($idCountryOne, $idCountryTwo) {
                $query->where('group_forwardings.countrie_id', $idCountryOne)
                    ->orWhere('group_forwardings.countrie_id', $idCountryTwo);
            })
            ->get();
    }
}
