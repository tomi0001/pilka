<x-appGuest-layout>
    <div class="main-page-countries">
        @if (count($listOldGroup) > 0)
            <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

            @include('guest.selectOldGroup', ['route' => 'guest.showCountries'])
        @endif


        <div class="grid grid-cols-2 gap-2">
            <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Przypisana grupa </div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                <span @class([
                    'font-bold',
                    'text-red-500' =>
                        \App\Http\Repositories\ProfileRepository::showNameGroup(
                            $idCountry,
                            session()->get('oldGroup')) == null,
                    'text-blue-500' =>
                        !\App\Http\Repositories\ProfileRepository::showNameGroup(
                            $idCountry,
                            session()->get('oldGroup')) == null,
                ])>
                    {!! \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry, session()->get('oldGroup')) == null
                        ? 'Nie przypisano do grupy'
                        : " <a href='" .
                            route('guest.showGroupForm', [
                                'group' => \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry, session()->get('oldGroup'))->group_id,
                            ]) .
                            "'> Grupa " .
                            \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry, session()->get('oldGroup'))->name .
                            '</a>' !!}
                </span>
            </div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Nazwa kraju </div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ \App\Models\Countrie::find($idCountry)->name }}</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy grupowych</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesGroup->count() }}</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Towarzyskich</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesFriendry->count() }}</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Pucharowych</div>
            <div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesCup->count() }}</div>

        </div>


        @if (!$listGamesGroup->isEmpty())
            <div
                class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 flex items-center justify-center">Mecze grupowe</div>
                </div>
            </div>
        @endif


        @foreach ($listGamesGroup as $game)
            <div class=" px-4 py-2 ">


            </div>
            <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4  col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4   col-span-8 flex items-center justify-center">
                    {{ substr($game->date, 0, 16) }}</div>
            </div>
            <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                <div class=" bg-blue-100 text-blue-800 px-1 py-4 !col-span-2 flex items-center justify-center">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4  !col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4   !col-span-4 flex items-center justify-center">
                    {{ substr($game->date, 0, 10) }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                <div class=" bg-blue-100 text-blue-800 px-1 py-4  !col-span-2 flex items-center justify-center">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ substr($game->date, 10, 6) }}</div>
            </div>
            <div class="m-7"></div>
        @endforeach

        @if (!$listGamesFriendry->isEmpty())
            <div
                class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-red-300 text-white mt-4 mb-4 mx-auto ">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mecze towarzyskie</div>
                </div>
            </div>
        @endif


        @foreach ($listGamesFriendry as $game)
            <div class=" px-4 py-2 ">

            </div>
            <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ $game->result_one != null ? $game->result_one : 'nie rozegrany' }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4  col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">
                    {{ $game->result_two != null ? $game->result_two : 'nie rozegrany' }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4   col-span-8 flex items-center justify-center">
                    {{ substr($game->date, 0, 16) }}</div>
            </div>

            <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                <div class=" bg-red-100 text-red-900 px-1 py-4 !col-span-2 flex items-center justify-center">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-red-100 text-red-900 px-4 py-4  !col-span-4 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4   !col-span-4 flex items-center justify-center">
                    {{ substr($game->date, 0, 10) }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ $game->result_one != null ? $game->result_one : 'nie rozegrany' }}</div>
                <div class=" bg-red-100 text-red-900 px-1 py-4  !col-span-2 flex items-center justify-center">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ $game->result_two != null ? $game->result_two : 'nie rozegrany' }}</div>
                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">
                    {{ substr($game->date, 10, 6) }}</div>
            </div>
            <div class="m-7"></div>
        @endforeach
        @if (!$listGamesCup->isEmpty())
            <div
                class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-green-700 text-gray-200 mt-4 mb-4 mx-auto ">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mecze Pucharowe</div>
                </div>
            </div>
        @endif


        @foreach ($listGamesCup as $game)
            <div class=" px-4 py-2 ">

            </div>
            <div class="!grid sm:!hidden   !grid-cols-12 !gap-1">
                <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 col-span-6 ">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                @if ($game->result_over_one !== null and $game->result_pena_one !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">
                        {{ $game->result_over_one !== null ? $game->result_over_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_pena_one !== null ? $game->result_pena_one : 'nie rozegrany' }}</div>
                @elseif ($game->result_over_one !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_over_one !== null ? $game->result_over_one : 'nie rozegrany' }}</div>
                @else
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-6">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 px-4 py-4  col-span-6 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                @if ($game->result_over_two !== null and $game->result_pena_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_over_two !== null ? $game->result_over_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_pena_two !== null ? $game->result_pena_two : 'nie rozegrany' }}</div>
                @elseif ($game->result_over_two !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_over_two !== null ? $game->result_over_two : 'nie rozegrany' }}</div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center  py-4 !col-span-6">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 py-4  flex items-center justify-center col-span-12 ">
                    {{ substr($game->date, 0, 16) }}</div>
            </div>
            <div class="!hidden sm:!grid  !grid-cols-21 !gap-1">
                <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6 ">
                    {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4 !col-span-3 ">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-6">
                    {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                <div class="bg-green-200 text-green-900  flex items-center justify-center py-4   !col-span-6 ">
                    {{ substr($game->date, 0, 10) }}</div>

                @if ($game->result_over_one !== null and $game->result_pena_one !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4    !col-span-2">
                        {{ $game->result_over_one !== null ? $game->result_over_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $game->result_pena_one !== null ? $game->result_pena_one : 'nie rozegrany' }}</div>
                @elseif ($game->result_over_one !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $game->result_over_one !== null ? $game->result_over_one : 'nie rozegrany' }}</div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6">
                        {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                @endif



                <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4  !col-span-3 ">
                    <span class="font-bold">vs</span>
                </div>
                @if ($game->result_over_two !== null and $game->result_pena_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">
                        {{ $game->result_over_two !== null ? $game->result_over_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">
                        {{ $game->result_pena_two !== null ? $game->result_pena_two : 'nie rozegrany' }}</div>
                @elseif ($game->result_over_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">
                        {{ $game->result_over_two !== null ? $game->result_over_two : 'nie rozegrany' }}</div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6">
                        {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6 ">
                    {{ substr($game->date, 10, 6) }}</div>
            </div>
            <div class="m-7"></div>
        @endforeach


</x-appGuest-layout>
