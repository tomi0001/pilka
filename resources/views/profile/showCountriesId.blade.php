<x-app-layout>
    <div class="main-page-countries">


            <div class="grid grid-cols-2 gap-2">

                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Nazwa kraju </div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ \App\Models\Countrie::find($idCountry)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy grupowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesGroup->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Towarzyskich</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesFriendry->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Pucharowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesCup->count() }}</div>

            </div>

            <div class="grid  grid-cols-3 gap-2">

                        @foreach ($listGamesGroup as $game)

                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>

                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">{{ ($game->result_one) }}</div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ ($game->result_two) }}</div>
                        @endforeach
            </div>

</x-app-layout>
