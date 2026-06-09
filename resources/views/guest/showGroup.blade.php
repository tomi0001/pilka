<x-appGuest-layout>
    <div class="main-page-view">
        @if (count($listOldGroup) > 0)
            <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

            @include('guest.selectOldGroup', ['route' => 'guest.showGroup'])
        @endif

        <form action="{{ route('guest.showGroupForm') }}" method="get" id="showGroup">

            <select name="group" id="group"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 form-select-group"
                onchange="document.getElementById('showGroup').submit()">
                @foreach ($listGroup as $group)
                    @if ($group->id == $selectedGroup)
                        <option value="{{ $group->id }}" selected>Grupa {{ $group->name }}</option>
                    @else
                        <option value="{{ $group->id }}">Grupa {{ $group->name }}</option>
                    @endif
                @endforeach
            </select>
        </form>



        @if ($listCountry->isEmpty())
            <p class="text-red-500 font-light text-xl mt-4">Brak krajów w tej grupie.</p>
        @else
            <div
                class="overflow-hidden rounded-3xl relative overflow-x-auto bg-neutral-primary-soft shadow-md rounded-base border border-default">

                <table class="w-full text-sm text-left rtl:text-right text-body min-w-full border-collapse "
                    id="groupTable">
                    <thead
                        class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-blue-400">
                        <tr>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                Kraj</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                RM</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                W</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                R</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                P</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                BZ</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                BS</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                RB</th>
                            <th
                                class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href">
                                PTK</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @for ($i = 0; $i < count($arrayPtk); $i++)
                            @if ($i < 2)
                                <tr class="bg-gray-100  border-blue-500">
                                @else
                                <tr>
                            @endif
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['name'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['RM'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['W'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['R'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['P'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['BZ'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['BS'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['RB'] }}</td>
                            <td class="px-8 py-4">{{ $arrayPtk[$i]['PTK'] }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        @endif


        <div class="main-page-show-game">
            @if ($listGame->isEmpty())
                <p class="text-red-500 font-light text-xl mt-4">Brak meczów w tej grupie.</p>
            @else
                <div
                    class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Mecze grupowe</div>
                    </div>
                </div>
                <div class="main-groups-game">
                    @foreach ($listGame as $game)
                        <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                                {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                                {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4  col-span-4 flex items-center justify-center">
                                {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">
                                {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4   col-span-8 flex items-center justify-center">
                                {{ substr($game->date, 0, 16) }}</div>
                        </div>
                        <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                                {{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                            <div
                                class=" bg-blue-100 text-blue-800 px-1 py-4 !col-span-2 flex items-center justify-center">
                                <span class="font-bold">vs</span>
                            </div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4  !col-span-4 flex items-center justify-center">
                                {{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4   !col-span-4 flex items-center justify-center">
                                {{ substr($game->date, 0, 10) }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                                {{ $game->result_one !== null ? $game->result_one : 'nie rozegrany' }}</div>
                            <div
                                class=" bg-blue-100 text-blue-800 px-1 py-4  !col-span-2 flex items-center justify-center">
                                <span class="font-bold">vs</span>
                            </div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                                {{ $game->result_two !== null ? $game->result_two : 'nie rozegrany' }}</div>
                            <div
                                class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">
                                {{ substr($game->date, 10, 6) }}</div>
                        </div>
                        <div class="m-7"></div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>


</x-appGuest-layout>
