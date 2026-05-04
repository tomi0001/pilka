<x-app-layout>
    <div class="main-page-game-edit">
        <form action="{{ route('profile.editGameSubmit', $game->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="grid grid-cols-2 gap-2">
                    <div class="bg-blue-100 text-blue-800 px-4 py-2  	flex items-center justify-center">
                        Wynik 1:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input  type="number" name="resultOne" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_one }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOne') }}" />


                    </div>

                    <div class="bg-blue-100 text-blue-800 px-4 py-2 	flex items-center justify-center">
                        Wynik 2:
                    </div>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                        <input type="number" name="resultTwo" autocomplete="family-name" max="255" min="0" step="1" value="{{ $game->result_two }}"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultTwo') }}" />
                    </div>

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
                <div class="mt-4">
                    <button type="submit" class="!bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edytuj
                    </button>
        </form>



    </div>
</x-app-layout>
