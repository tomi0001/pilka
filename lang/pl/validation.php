<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'required_with' => 'Wynik jest wymagany, gdy drugi wynik jest obecny',
    'registration_closed' => 'Rejestracja jest już zamknięta.',
    'ifExistGroup' => 'Już jest taka grupy o tej nazwie',
    'ifExistCountry' => 'Już jest taki kraj o tej nazwie',
    'ifExistGame' => 'Państwa należa do innych grup',

    'result' => 'Błędny wynik',
    'ifExistGameCloseGroup' => 'Państwo nie należy do żadnej grupy lub należy do grupy zamkniętej',
    'listStatusErrorCountryIfGameExist' => 'Państwo należy do grupy, w której jest już zaplanowany mecz z jedną z tych drużyn',
    'listStatusErrorGamesCup' => 'W grupie jest już zaplanowany mecz z wynikiem',
    'listStatusErrorFirstCup' => 'Państwo nie znalazło się w poprzednim finale',
    'listStatusChcekIfGameExistCup' => 'W poprzednim finale te dwie drużyny już się spotkały',
    'ifExistGameDate' => 'W tym dniu i o tej godzinie jest już zaplanowany mecz z jedną z tych drużyn',
    'different' => 'Państwa muszą być różne',
    'ifExistGameNullGame' => 'Nie można dodać meczu z drużyną, która nie jest przypisana do żadnej grupy',
    'custom' => [
        'password' => [
            'min' => 'Hasło musi mieć minimum :min znaków',
        ],
        'result_error' => 'Nie można dodać meczu z wynikiem, gdy grupa jest otwarta',
        'name' => [
            'max' => 'Nazwa grupy musi mieć jeden znak',
            'required' => 'Uzupełnij pole nazwa grupy',
        ],
        'countryOne' => [
            'required' => 'Wybierz pierwszą drużynę',
        ],
        'countryTwo' => [
            'required' => 'Wybierz drugą drużynę',
        ],
        'date' => [
            'required' => 'Wybierz datę meczu',
            'date' => 'Wybierz poprawną datę',
        ],
        'time' => [
            'required' => 'Wybierz godzinę meczu',
            'date_format' => 'Wybierz poprawną godzinę',
        ],
        'resultOne' => [
            'integer' => 'Wynik musi być liczbą',
            'min' => 'Wynik nie może być mniejszy niż :min',
            'max' => 'Wynik nie może być większy niż :max',
        ],
        'resultTwo' => [
            'integer' => 'Wynik musi być liczbą',
            'min' => 'Wynik nie może być mniejszy niż :min',
            'max' => 'Wynik nie może być większy niż :max',
        ],
    ],
    'confirmed' => 'Hasła musza być identyczne',


    'attributes' => [],

];
