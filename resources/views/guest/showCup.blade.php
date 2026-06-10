<x-appGuest-layout>
    @section ('title')
        Przeglądaj Mecze Fazy Pucharowej
    @endsection
    <div class="main-page-cup">
        @if (count($listOldGroup) > 0)
            <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

            @include('guest.selectOldGroup', ['route' => 'guest.showCup'])
        @endif
        @for ($i = 0; $i < count($list); $i++)
            @if ($i == 0)
                <div
                    class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4 ">
                        @if ($list[$i]->status == 0)
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">Finał</div>
                        @elseif ($list[$i]->status == 1)
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">Mecz o 3 miesjce</div>
                        @else
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">
                                1/{{ $list[$i]->status }} finału</div>
                        @endif
                    </div>
                </div>
            @elseif ($list[$i]->status != $list[$i - 1]->status)
                <div
                    class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4 ">
                        @if ($list[$i]->status == 0)
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">Finał</div>
                        @elseif ($list[$i]->status == 1)
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">Mecz o 3 miesjce</div>
                        @else
                            <div class="font-bold text-xl mb-2 flex items-center justify-center ">
                                1/{{ $list[$i]->status }} finału</div>
                        @endif
                    </div>
                </div>
            @endif

            <div class=" px-4 py-2 ">

            </div>
            <div class="!grid sm:!hidden   !grid-cols-12 !gap-1">
                <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 col-span-6 ">
                    {{ \App\Models\Countrie::find($list[$i]->country_one)->name }}</div>
                @if ($list[$i]->result_over_one !== null and $list[$i]->result_pena_one !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">
                        {{ $list[$i]->result_over_one !== null ? $list[$i]->result_over_one : 'nie rozegrany' }}
                    </div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_pena_one !== null ? $list[$i]->result_pena_one : 'nie rozegrany' }}
                    </div>
                @elseif ($list[$i]->result_over_one !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_over_one !== null ? $list[$i]->result_over_one : 'nie rozegrany' }}
                    </div>
                @else
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-6">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 px-4 py-4  col-span-6 flex items-center justify-center">
                    {{ \App\Models\Countrie::find($list[$i]->country_two)->name }}</div>
                @if ($list[$i]->result_over_two !== null and $list[$i]->result_pena_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_over_two !== null ? $list[$i]->result_over_two : 'nie rozegrany' }}
                    </div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_pena_two !== null ? $list[$i]->result_pena_two : 'nie rozegrany' }}
                    </div>
                @elseif ($list[$i]->result_over_two !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_over_two !== null ? $list[$i]->result_over_two : 'nie rozegrany' }}
                    </div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center  py-4 !col-span-6">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 py-4  flex items-center justify-center col-span-12 ">
                    {{ substr($list[$i]->date, 0, 16) }}</div>
            </div>
            <div class="!hidden sm:!grid  !grid-cols-21 !gap-1">
                <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6 ">
                    {{ \App\Models\Countrie::find($list[$i]->country_one)->name }}</div>
                <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4 !col-span-3 ">
                    <span class="font-bold">vs</span>
                </div>
                <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-6">
                    {{ \App\Models\Countrie::find($list[$i]->country_two)->name }}</div>
                <div class="bg-green-200 text-green-900  flex items-center justify-center py-4   !col-span-6 ">
                    {{ substr($list[$i]->date, 0, 10) }}</div>

                @if ($list[$i]->result_over_one !== null and $list[$i]->result_pena_one !== null)
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4    !col-span-2">
                        {{ $list[$i]->result_over_one !== null ? $list[$i]->result_over_one : 'nie rozegrany' }}
                    </div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">
                        {{ $list[$i]->result_pena_one !== null ? $list[$i]->result_pena_one : 'nie rozegrany' }}
                    </div>
                @elseif ($list[$i]->result_over_one !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">
                        {{ $list[$i]->result_over_one !== null ? $list[$i]->result_over_one : 'nie rozegrany' }}
                    </div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6">
                        {{ $list[$i]->result_one !== null ? $list[$i]->result_one : 'nie rozegrany' }}</div>
                @endif



                <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4  !col-span-3 ">
                    <span class="font-bold">vs</span>
                </div>
                @if ($list[$i]->result_over_two !== null and $list[$i]->result_pena_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">
                        {{ $list[$i]->result_over_two !== null ? $list[$i]->result_over_two : 'nie rozegrany' }}
                    </div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">
                        {{ $list[$i]->result_pena_two !== null ? $list[$i]->result_pena_two : 'nie rozegrany' }}
                    </div>
                @elseif ($list[$i]->result_over_two !== null)
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">
                        {{ $list[$i]->result_over_two !== null ? $list[$i]->result_over_two : 'nie rozegrany' }}
                    </div>
                @else
                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6">
                        {{ $list[$i]->result_two !== null ? $list[$i]->result_two : 'nie rozegrany' }}</div>
                @endif
                <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6 ">
                    {{ substr($list[$i]->date, 10, 6) }}</div>
            </div>
            <div class="m-7"></div>

        @endfor
        @if (count($list) == 0)
            <p class="text-red-500 font-light text-xl mt-4">Brak meczy fazy pucharowej.</p>
        @endif
    </div>
</x-appGuest-layout>
