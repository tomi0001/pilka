<x-app-layout>
    <div class="main-page-countries">
        @if (count($listOldGroup) > 0)
                <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

                 @include('profile.selectOldGroup', ['route' => 'profile.showCountries'])

        @endif


            <div class="grid grid-cols-2 gap-2">
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Przypisana grupa </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                    <span @class([
                       'font-bold',
                        'text-red-500' => \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry,session()->get('oldGroup')) == null,
                       'text-blue-500' => ! \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry,session()->get('oldGroup')) == null,
                       ])>
                       {!!    \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry,session()->get('oldGroup')) == null ?
                        "Nie przypisano do grupy" :
                       " <a href='" . route('profile.showGroupForm', ['group' => \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry,session()->get('oldGroup'))->group_id]) . "'> Grupa " . \App\Http\Repositories\ProfileRepository::showNameGroup($idCountry,session()->get('oldGroup'))->name . "</a>" !!}
                         </span>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Nazwa kraju </div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ \App\Models\Countrie::find($idCountry)->name }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy grupowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesGroup->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Towarzyskich</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesFriendry->count() }}</div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 "> Liczba meczy Pucharowych</div><div class="bg-blue-100 text-blue-800 px-4 py-2">{{ $listGamesCup->count() }}</div>

            </div>
            @if ($listGamesGroup->isEmpty() and $listGamesCup->isEmpty() and $listGamesFriendry->isEmpty() and  $listOldGroup->isEmpty())
                <div class="container py-10 px-10 mx-0 min-w-full flex flex-col items-center">
                    <button command="show-modal" commandfor="dialog"  class="!bg-red-500   text-white text-bold  py-2 px-4 ">Usuń Państwo</button>
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
                                    <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Usunięcie Państwa</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Czy na pewno chcesz usunąć tę Państwo? Wszystkie dane zostaną trwale usunięte. tej akcji nie można cofnąć.</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">





                                    <form action="{{ route('profile.deleteCountry', $idCountry) }}" method="POST">
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
            @endif
            @if ($listGamesGroup->isEmpty() and $listGamesCup->isEmpty())
                <div class="container py-10 px-1  min-w-full ">
                    Zmień grupę
                    <form action="{{ route('profile.changeGroup') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="groupChange" id="groupChange" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 form-select-group">
                            <option value="0" {{   empty(\App\Models\Group_forwarding::checkForwarding($idCountry)) ? 'selected' : '' }}>Nie przepisuj do żadnej grupy</option>
                            @foreach (\App\Models\Group::showGroup() as $item)
                                @if (!empty(\App\Models\Group_forwarding::checkForwarding($idCountry)) and \App\Models\Group_forwarding::checkForwarding($idCountry)->group_id == $item->id)
                                    <option value="{{ $item->id }}"  selected>Grupa {{ $item->name }}</option>
                                @else
                                     <option value="{{ $item->id }}" >Grupa {{ $item->name }}</option>
                                @endif


                            @endforeach
                        </select>
                        <input type="hidden" name="idCountry" value="{{ $idCountry }}">
                        <button class="!bg-green-500 text-white text-bold  py-2 px-4">Zmień grupę</button>
                    </form>
                </div>



            @endif
            @if (!$listGamesGroup->isEmpty())
                <div class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-blue-500 text-gray-200 mt-4 mb-4 mx-auto ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 flex items-center justify-center">Mecze grupowe</div>
                    </div>
                </div>
            @endif


                        @foreach ($listGamesGroup as $game)

                            <div class=" px-4 py-2 ">
                                    @if (Auth::user()->status < 0 and session()->get('oldGroup') == 0)
                                        <button command="show-modal" commandfor="dialog_{{ $game->id }}"  class="!bg-red-500 px-4 py-2 !rounded text-white">Usuń mecz</button>
                                            <el-dialog>
                                                <dialog id="dialog_{{ $game->id }}" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
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
                                                                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Usunięcie meczu</h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">Czy na pewno chcesz usunąć ten mecz? Wszystkie dane zostaną trwale usunięte. tej akcji nie można cofnąć.</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">





                                                                <form action="{{ route('profile.deleteGame')}}/{{$game->id}}/{{$idCountry}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <x-danger-button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3" >
                                                                        {{ __('Usuń') }}
                                                                    </x-danger-button>
                                                                </form>

                                                            <button type="button" command="close" commandfor="dialog_{{ $game->id }}"   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" >Anuluj</button>
                                                            </div>
                                                        </el-dialog-panel>
                                                    </div>
                                                </dialog>
                                            </el-dialog>
                                        <a href="{{ route('profile.editGame', $game->id) }}">
                                            <button class="!bg-green-500 px-4 py-2 !rounded text-white">Edytuj mecz</button>
                                        </a>
                                    @endif

                            </div>
                            <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4  col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 col-span-4 flex items-center justify-center">{{ ($game->result_two !== null ? $game->result_two : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4   col-span-8 flex items-center justify-center">{{ substr($game->date, 0, 16) }}</div>
                            </div>
                            <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    <div class=" bg-blue-100 text-blue-800 px-1 py-4 !col-span-2 flex items-center justify-center">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4  !col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4   !col-span-4 flex items-center justify-center">{{ substr($game->date, 0, 10) }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    <div class=" bg-blue-100 text-blue-800 px-1 py-4  !col-span-2 flex items-center justify-center">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">{{ ($game->result_two !== null ? $game->result_two : 'nie rozegrany') }}</div>
                                    <div class="bg-blue-100 text-blue-800 px-4 py-4 !col-span-4 flex items-center justify-center">{{ substr($game->date, 10, 6) }}</div>
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
                        <div class=" px-4 py-2 ">
                            @if (session()->get('oldGroup') == 0)
                                <button command="show-modal" commandfor="dialog_{{ $game->id }}"  class="!bg-red-500 px-4 py-2 !rounded text-white">Usuń mecz</button>
                                    <el-dialog>
                                        <dialog id="dialog_{{ $game->id }}" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
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
                                                        <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Usunięcie meczu</h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">Czy na pewno chcesz usunąć ten mecz? Wszystkie dane zostaną trwale usunięte. tej akcji nie można cofnąć.</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">





                                                        <form action="{{ route('profile.deleteGame')}}/{{$game->id}}/{{$idCountry}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-danger-button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3" >
                                                                {{ __('Usuń') }}
                                                            </x-danger-button>
                                                        </form>

                                                    <button type="button" command="close" commandfor="dialog_{{ $game->id }}"   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" >Anuluj</button>
                                                    </div>
                                                </el-dialog-panel>
                                            </div>
                                        </dialog>
                                    </el-dialog>
                                <a href="{{ route('profile.editGame', $game->id) }}">
                                    <button class="!bg-green-500 px-4 py-2 !rounded text-white">Edytuj mecz</button>
                                </a>
                            @endif
                        </div>
                        <div class="!grid sm:!hidden   !grid-cols-8 !gap-1">
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4  col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 col-span-4 flex items-center justify-center">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4   col-span-8 flex items-center justify-center">{{ substr($game->date, 0, 16) }}</div>
                        </div>

                        <div class="!hidden sm:!grid  !grid-cols-14 !gap-1">
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                <div class=" bg-red-100 text-red-900 px-1 py-4 !col-span-2 flex items-center justify-center">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-red-100 text-red-900 px-4 py-4  !col-span-4 flex items-center justify-center">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4   !col-span-4 flex items-center justify-center">{{ substr($game->date, 0, 10) }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">{{ ($game->result_one != null  ? $game->result_one : 'nie rozegrany') }}</div>
                                <div class=" bg-red-100 text-red-900 px-1 py-4  !col-span-2 flex items-center justify-center">
                                    <span class="font-bold">vs</span>
                                </div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">{{ ($game->result_two != null ? $game->result_two : 'nie rozegrany') }}</div>
                                <div class="bg-red-100 text-red-900 px-4 py-4 !col-span-4 flex items-center justify-center">{{ substr($game->date, 10, 6) }}</div>
                        </div>
                        <div class="m-7"></div>
                    @endforeach
                    @if (!$listGamesCup->isEmpty())
                                    <div class="max-w-sm md:max-w-lg w-80 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-green-700 text-gray-200 mt-4 mb-4 mx-auto ">
                                        <div class="px-6 py-4">
                                            <div class="font-bold text-xl mb-2">Mecze Pucharowe</div>
                                        </div>
                                    </div>
                    @endif


                    @foreach ($listGamesCup as $game)
                            <div class=" px-4 py-2 ">
                                    @if (Auth::user()->status == $game->status  and session()->get('oldGroup') == 0)
                                        <button command="show-modal" commandfor="dialog_{{ $game->id }}"  class="!bg-red-500 px-4 py-2 !rounded text-white">Usuń mecz</button>
                                            <el-dialog>
                                                <dialog id="dialog_{{ $game->id }}" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
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
                                                                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Usunięcie meczu</h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">Czy na pewno chcesz usunąć ten mecz? Wszystkie dane zostaną trwale usunięte. tej akcji nie można cofnąć.</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">





                                                                <form action="{{ route('profile.deleteGame')}}/{{$game->id}}/{{$idCountry}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <x-danger-button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3" >
                                                                        {{ __('Usuń') }}
                                                                    </x-danger-button>
                                                                </form>

                                                            <button type="button" command="close" commandfor="dialog_{{ $game->id }}"   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" >Anuluj</button>
                                                            </div>
                                                        </el-dialog-panel>
                                                    </div>
                                                </dialog>
                                            </el-dialog>
                                        <a href="{{ route('profile.editGame', $game->id) }}">
                                            <button class="!bg-green-500 px-4 py-2 !rounded text-white">Edytuj mecz</button>
                                        </a>
                                    @endif
                            </div>
                            <div class="!grid sm:!hidden   !grid-cols-12 !gap-1">
                                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 col-span-6 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    @if ( $game->result_over_one !== null and $game->result_pena_one !== null)
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">{{ ($game->result_over_one !== null  ? $game->result_over_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">{{ ($game->result_pena_one !== null  ? $game->result_pena_one : 'nie rozegrany') }}</div>

                                    @elseif ($game->result_over_one !== null )
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">{{ ($game->result_over_one !== null  ? $game->result_over_one : 'nie rozegrany') }}</div>
                                    @else
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-6">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    @endif
                                    <div class="bg-green-200 text-green-900 px-4 py-4  col-span-6 flex items-center justify-center" >{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    @if ( $game->result_over_two !== null and $game->result_pena_two !== null)
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-2">{{ ($game->result_over_two !== null  ? $game->result_over_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">{{ ($game->result_pena_two !== null  ? $game->result_pena_two : 'nie rozegrany') }}</div>

                                    @elseif ($game->result_over_two !== null )
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-3">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">{{ ($game->result_over_two !== null  ? $game->result_over_two : 'nie rozegrany') }}</div>
                                    @else
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center  py-4 !col-span-6">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                    @endif
                                    <div class="bg-green-200 text-green-900 py-4  flex items-center justify-center col-span-12 ">{{ substr($game->date, 0, 16) }}</div>
                            </div>
                            <div class="!hidden sm:!grid  !grid-cols-21 !gap-1">
                                    <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6 ">{{ \App\Models\Countrie::find($game->country_one)->name }}</div>
                                    <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4 !col-span-3 ">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-6">{{ \App\Models\Countrie::find($game->country_two)->name }}</div>
                                    <div class="bg-green-200 text-green-900  flex items-center justify-center py-4   !col-span-6 ">{{ substr($game->date, 0, 10) }}</div>

                                    @if ( $game->result_over_one !== null and $game->result_pena_one !== null)
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4    !col-span-2">{{ ($game->result_over_one !== null  ? $game->result_over_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4 !col-span-2">{{ ($game->result_pena_one !== null  ? $game->result_pena_one : 'nie rozegrany') }}</div>

                                    @elseif ($game->result_over_one !== null )
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-3">{{ ($game->result_over_one !== null  ? $game->result_over_one : 'nie rozegrany') }}</div>
                                    @else
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center py-4 !col-span-6">{{ ($game->result_one !== null  ? $game->result_one : 'nie rozegrany') }}</div>
                                    @endif



                                    <div class=" bg-green-200 text-green-900 flex items-center justify-center px-1 py-4  !col-span-3 ">
                                        <span class="font-bold">vs</span>
                                    </div>
                                    @if ( $game->result_over_two !== null and $game->result_pena_two !== null)
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900  flex items-center justify-center py-4  !col-span-2">{{ ($game->result_over_two !== null  ? $game->result_over_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-2">{{ ($game->result_pena_two !== null  ? $game->result_pena_two : 'nie rozegrany') }}</div>

                                    @elseif ($game->result_over_two !== null )
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-3">{{ ($game->result_over_two !== null  ? $game->result_over_two : 'nie rozegrany') }}</div>
                                    @else
                                        <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6">{{ ($game->result_two !== null  ? $game->result_two : 'nie rozegrany') }}</div>
                                    @endif
                                    <div class="bg-green-200 text-green-900 flex items-center justify-center px-4 py-4 !col-span-6 ">{{ substr($game->date, 10, 6) }}</div>
                            </div>
                            <div class="m-7"></div>

                    @endforeach


</x-app-layout>
