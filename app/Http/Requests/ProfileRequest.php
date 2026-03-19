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
}
