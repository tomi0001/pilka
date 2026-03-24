<?php

namespace App\Http\Requests;

use App\Http\Services\Profile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
{
    public function addGroup(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:1'],
        ]);
        $Profile = new Profile;
        if ($Profile->ifExistGroup($request->get('name'))) {
            return back()->withErrors([
                'name' => __('validation.ifExistGroup'),
            ]);
        }
    }

    public function addCountry(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
        ]);
        $Profile = new Profile;
        if ($Profile->ifExistCountry($request->get('name'))) {
            return back()->withErrors([
                'name' => __('validation.ifExistCountry'),
            ]);
        }
    }

    public function addGame(Request $request)
    {
        $request->validate([
            'countryOne' => ['required', 'integer'],
            'countryTwo' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'resultOne' => ['nullable','integer', 'min:0', 'max:300'],
            'resultTwo' => ['nullable','integer', 'min:0', 'max:300'],
        ]);
    }
}
