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
            'countryOne' => ['required', 'integer', 'different:countryTwo',
                function ($attribute, $value, $fail) use ($request, $Profile) {
                    if ($request->get('type') < 0) {

                        if (count($Profile->checkGame($request)) > 1) {
                            $fail(__('validation.ifExistGame'));
                        }
                        if ($Profile->checkGameNullGame($request->get('countryOne')) == null) {
                            $fail(__('validation.ifExistGameNullGame'));
                        }
                    } else {
                        $Profile->chcekErrorCup($request->get('countryOne'));
                        if ($Profile->listStatusErrorForCloseGroup  == false) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }
                        if ( ($Profile->listStatusErrorCountryIfGameExist  == false)) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }

                        if ( ($Profile->listStatusErrorGamesCup  == false)) {
                            $fail(__('validation.listStatusErrorGamesCup'));
                        }

                        if ( ($Profile->listStatusErrorFirstCup  == false)) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }
                    }
                },

            ],
            'countryTwo' => ['required', 'integer',
                function ($attribute, $value, $fail) use ($request, $Profile) {
                    if ($request->get('type') < 0) {

                        if ($Profile->checkGameNullGame($request->get('countryTwo')) == null) {
                            $fail(__('validation.ifExistGameNullGame'));
                        }
                        if (($Profile->checkGameDate($request))) {
                            $fail(__('validation.ifExistGameDate'));
                        }
                    } else {
                        $Profile->chcekErrorCup($request->get('countryTwo'));
                        if ( ($Profile->listStatusErrorForCloseGroup  == false)) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }
                        if ( ($Profile->listStatusErrorCountryIfGameExist  == false)) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }

                        if ( ($Profile->listStatusErrorGamesCup  == false)) {
                            $fail(__('validation.listStatusErrorGamesCup'));
                        }

                        if ( ($Profile->listStatusErrorFirstCup  == false)) {
                            $fail(__('validation.ifExistGameCloseGroup'));
                        }
                        if ($this->checkResult($request) == -1) {
                            $fail(__('validation.result'));
                        }
                    }
                },
            ],
            // 'result_error' => ['required', 'integer', 'in:0,2',
            //     function ($fail) use ($request) {
            //         if ($request->get('type') >= 0 and $this->checkResult($request) == -1) {
            //             $fail(__('validation.result'));

            //         }
            //     },
            // ],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'resultOne' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:resultTwo'],
            'resultTwo' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:resultOne'],
            'result_over_one' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:result_over_two'],
            'result_over_two' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:result_over_one'],
            'result_pena_one' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:result_pena_two'],
            'result_pena_two' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:result_pena_one'],
        ]);

    }

    public function editGame(Request $request, int $id)
    {
        $Profile = new Profile;
        $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'resultOne' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:resultTwo'],
            'resultTwo' => ['nullable', 'integer', 'min:0', 'max:255', 'required_with:resultOne'],
        ]);
    }

    private function checkResult(Request $request)
    {

        if ($request->get('resultOne') == null and $request->get('result_over_one') == null and $request->get('result_pena_one') == null) {
            return 0;
        } else {
            if ($request->get('resultOne') != null and $request->get('result_over_one') == null and $request->get('result_pena_one') == null) {
                if ($request->get('resultOne') != $request->get('resultTwo')) {
                    return 0;
                }
            } elseif ($request->get('resultOne') != null and $request->get('result_over_one') != null and $request->get('result_pena_one') == null) {

                if ($request->get('result_over_one') != $request->get('result_over_two') and ($request->get('resultOne') == $request->get('resultTwo')  ) ) {
                    return 0;
                }
            } elseif ($request->get('resultOne') != null and $request->get('result_over_one') != null and $request->get('result_pena_one') != null) {

                if ( ($request->get('result_pena_one') != $request->get('result_pena_two')) and ($request->get('result_over_one') == $request->get('result_over_two')  ) and ($request->get('resultOne') == $request->get('resultTwo') )) {
                    return 0;
                } else {
                    return -1;
                }

            }
        }

        return -1;

    }
}
