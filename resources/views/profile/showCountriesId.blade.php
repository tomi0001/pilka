<x-app-layout>
    <div class="main-page-countries">


            <div class="grid grid-cols-2 gap-2">

                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Nazwa kraju </div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ \App\Models\Countrie::find($idCountry)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy grupowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesGroup->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Towarzyskich</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesFriendry->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Pucharowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesCup->count() }}</div>

            </div>
            @if (!$listGamesGroup->isEmpty())
                <div class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Mecze grupowe</div>
                    </div>
                </div>
            @endif


                        @foreach ($listGamesGroup as $game)
                            <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4  col-span-4">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4   col-span-8 ">{{ substr($game->date, 0, 16) }}</div>
                            </div>
                            <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    <div class=" bg-blue-100 text-blue-800 px-1 py-4 !col-span-2 ">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4  !col-span-4">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4   !col-span-4 ">{{ substr($game->date, 0, 10) }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    <div class=" bg-blue-100 text-blue-800 px-1 py-4  !col-span-2 ">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 ">{{ substr($game->date, 10, 6) }}</div>
                            </div>
                            <div class="m-7"></div>

                         @endforeach

            @if (!$listGamesFriendry->isEmpty())
                <div class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-red-300 text-white mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Mecze towarzyskie</div>
                    </div>
                </div>
            @endif


                    @foreach ($listGamesFriendry as $game)
                        <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4  col-span-4">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4   col-span-8 ">{{ substr($game->date, 0, 16) }}</div>
                        </div>
                        <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                <div class=" bg-red-100 text-red-900 px-1 py-4 !col-span-2 ">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-red-100 text-red-900 px-4 py-4  !col-span-4">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4   !col-span-4 ">{{ substr($game->date, 0, 10) }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                <div class=" bg-red-100 text-red-900 px-1 py-4  !col-span-2 ">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 ">{{ substr($game->date, 10, 6) }}</div>
                        </div>
                        <div class="m-7"></div>
                    @endforeach


</x-app-layout>
