<x-app-layout>
    <div class="main-page-game-edit">
        <form action="{{ route('profile.editGameSubmit', $game->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="grid grid-cols-2 gap-2">
                    <input type="hidden" name="countryOne" value="{{ $game->country_one }}">
                    <input type="hidden" name="countryTwo" value="{{ $game->country_two }}">

                    <div class="bg-blue-100 text-blue-800 px-4 py-2  	flex items-center justify-center">
                        Wynik: <br> {{ \App\Models\Countrie::find($game->country_one)->name }}:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input  type="number" name="resultOne" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_one }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOne') }}" />


                    </div>

                    <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                        Wynik: <br> {{ \App\Models\Countrie::find($game->country_two)->name }}:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input type="number" name="resultTwo" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_two }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultTwo') }}" />
                    </div>
                    @if ($game->status >= 0)
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                            Wynik Dogrywki: <br> {{ \App\Models\Countrie::find($game->country_one)->name }}:
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                            <input type="number" name="result_over_one" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_over_one }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOverOne') }}" />
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                            Wynik Dogrywki: <br> {{ \App\Models\Countrie::find($game->country_two)->name }}:
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                            <input type="number" name="result_over_two" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_over_two }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOverTwo') }}" />
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                            Wynik rzutów karnych: <br> {{ \App\Models\Countrie::find($game->country_one)->name }}:
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                            <input type="number" name="result_pena_one" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_pena_one }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultPenaOne') }}" />
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                            Wynik rzutów karnych: <br> {{ \App\Models\Countrie::find($game->country_two)->name }}:
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                            <input type="number" name="result_pena_two" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_pena_two }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultPenaTwo') }}" />
                        </div>
                    @endif


                    <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                        Data:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input type="date" name="date" id="date" value="{{  substr($game->date, 0, 10)   }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>

                    <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                        Czas:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input type="time" name="time" id="time" value="{{ substr($game->date, 11, 5) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>
                 <x-input-error :messages="$errors->get('time')" class="mt-2" />
                 <x-input-error :messages="$errors->get('date')" class="mt-2" />
                 <x-input-error :messages="$errors->get('resultTwo')" class="mt-2" />
                 <x-input-error :messages="$errors->get('resultOne')" class="mt-2" />
                 <x-input-error :messages="$errors->get('result_pena_one')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_pena_two')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_error')" class="mt-2" />
                                     <x-input-error :messages="$errors->get('result_over_one')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_over_two')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('countryOne')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('countryTwo')" class="mt-2" />
                <div class="mt-4">
                    <button type="submit" class="!bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edytuj
                    </button>
                    @if (session('success'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-center " role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
        </form>



    </div>
</x-app-layout>
