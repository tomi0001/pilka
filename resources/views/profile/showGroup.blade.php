<x-app-layout>
    <div class="main-page-view">
        <form action="{{ route('profile.showGroupForm') }}" method="get" id="showGroup">

            <select name="group" id="group" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 form-select-group" onchange="document.getElementById('showGroup').submit()">
                @foreach ($listGroup as $group)
                    @if ($group->id == $selectedGroup)
                        <option value="{{ $group->id }}" selected>Grupa {{ $group->name }}</option>
                    @else
                        <option value="{{ $group->id }}">Grupa {{ $group->name }}</option>
                    @endif
                @endforeach
            </select>
        </form>
    @if ($listGame->isEmpty())

<div class="container py-10 px-10 mx-0 min-w-full flex flex-col items-center">
        <button command="show-modal" commandfor="dialog"  class="!bg-red-500   text-white text-bold  py-2 px-4 ">Usuń grupę</button>
</div>
     <el-dialog>
                <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                    <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                    <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                        <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Usunięcie grupy</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Czy na pewno chcesz usunąć tę grupę? Wszystkie dane zostaną trwale usunięte. tej akcji nie można cofnąć.</p>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">





                                <form action="{{ route('profile.deleteGroup', $selectedGroup) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3" >
                    {{ __('Usuń') }}
                </x-danger-button>
                                </form>

                            <button type="button" command="close" commandfor="dialog"   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" >Anuluj</button>
                            </div>
                        </el-dialog-panel>
                    </div>
                </dialog>
            </el-dialog>

    @else
        <button class="!bg-red-200   text-white text-bold  py-2 px-4 rounded rounded cursor-not-allowed ">Usuń grupę</button>


    @endif
    @if ($listCountry->isEmpty())
        <p class="text-red-500 font-light text-xl mt-4">Brak krajów w tej grupie.</p>
    @else
        <div class="overflow-hidden rounded-3xl relative overflow-x-auto bg-neutral-primary-soft shadow-md rounded-base border border-default">

         <table class="w-full text-sm text-left rtl:text-right text-body min-w-full border-collapse " id="groupTable">
            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-blue-400">
                <tr>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(0)">Kraj</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">RM</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">W</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">R</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">P</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">BZ</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">BS</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">RB</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">PTK</th>
                </tr>
            </thead>
            <tbody  class="">
                @for($i=0;$i < count($arrayPtk); $i++)
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
                <div class="overflow-hidden rounded-3xl relative overflow-x-auto bg-neutral-primary-soft shadow-md rounded-base border border-default mt-6">

                    <table class="w-full text-sm text-left rtl:text-right text-body min-w-full border-collapse " id="gameTable">
                        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-blue-400">
                            <tr>
                                <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(0)">Data</th>
                                <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">Kraj 1</th>
                                <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">Wynik</th>
                                <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">Kraj 2</th>
                            </tr>
                        </thead>
                        <tbody  class="divide-y divide-gray-200">
                            @foreach ($listGame as $game)
                                <tr>
                                    <td class="px-8 py-4">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y H:i') }}</td>
                                    <td class="px-8 py-4">{{ \App\Models\Countrie::showCountryName($game->country_one)->name }}</td>
                                    <td class="px-8 py-4">{{ $game->result_one }} - {{ $game->result_two }}</td>
                                    <td class="px-8 py-4">{{ \App\Models\Countrie::showCountryName($game->country_two)->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endif
        </div>

    </div>



</x-app-layout>
