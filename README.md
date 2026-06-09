npm install
npm run build

## O Aplikacji

Aplikacja słuzy do prowadzenia dzienniczka bazy meczy coś na zasadzie mistrzostw świata lub Europy, można dodawać mecze i zapisywać je i wyświetlać grupy tak jak e mistrzostaw w piłce nożnej, aplikacja została napisane w języku skryptowym PHP 8.4 w frameworku laravel i obsługuje baze danych mysql

## Wyamagania aplikacji

    - Apache
    - PHP wersja minimum 8.5
    - Mysql
    - Laravel wersja 12
    - npm
    - composer

## Postęp instalacji

    - git clone https://github.com/tomi0001/pilka
    - cd ./pilka
    - composer update
    - composer install
    - cp .env.example .env
    - npm install
    - npm run build
    - php artisan key:generate
    - Tworzymy bazę danych o nazwie pilka_
    - użytkownik bazy danych to domyslnie root i hasło a1234
    - php artisan migrate
    - chmod -R 777 storage
    - przeglądarce wpisujemy http://127.0.0.1/pilka/public
