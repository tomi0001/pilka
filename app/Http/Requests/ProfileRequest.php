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
        $Profile = new Profile;
        $request->validate([
            'countryOne' => ['required', 'integer','different:countryTwo',
                function ($attribute, $value,$fail) use ($request,$Profile) {
                    if ($request->get('type') != 2) {

                        if (count($Profile->checkGame($request))  > 1) {
                            $fail(__('validation.ifExistGame'));
                        }
                        if ($Profile->checkGameNullGame($request->get("countryOne")) == null) {
                            $fail(__('validation.ifExistGameNullGame'));
                        }
                    }
                }

            ],
            'countryTwo' => ['required', 'integer',
                function ($attribute, $value,$fail) use ($request,$Profile) {
                    if ($request->get('type') != 2) {

                        if ($Profile->checkGameNullGame($request->get("countryTwo")) == null) {
                            $fail(__('validation.ifExistGameNullGame'));
                        }
                        if (($Profile->checkGameDate($request))  ) {
                            $fail(__('validation.ifExistGameDate'));
                        }
                    }
                }
            ],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'resultOne' => ['nullable','integer', 'min:0', 'max:300', 'required_with:resultTwo'],
            'resultTwo' => ['nullable','integer', 'min:0', 'max:300', 'required_with:resultOne'],
        ]);

    }

}
