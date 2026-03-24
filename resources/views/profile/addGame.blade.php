<x-app-layout>
    <div class="main-page-addGame">
        <form action="{{ route('profile.addGameSubmit') }}" method="get">

            <table class="table-auto mx-auto">
                <tr>
                    <td class="px-8 w-80">
                        <span class="text-gray-600 font-light text-xl "> Wybierz kraj gospodarz</span>
                    </td>
                    <td class="w-80">
                         <select name="countryOne" id="countryOne" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value=""></option>
                            @foreach ($listCountry as $country)

                                <option value="{{ $country->id }}"  @selected(old('countryOne') == $country->id ? true : false)>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="py-4">

                    </td>
                    <td>
                        <x-input-error :messages="$errors->get('countryOne')" class="mt-2" />
                    </td>
                </tr>
                <tr>
                    <td class="px-8 w-80">
                        <span class="text-gray-600 font-light text-xl "> Wybierz kraj gościa</span>
                    </td>
                    <td class="w-80">
                        <select name="countryTwo" id="countryTwo" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value=""></option>
                            @foreach ($listCountry as $country)

                                <option value="{{ $country->id }}" @selected(old('countryTwo') == $country->id ? true : false)>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td  class="py-4">

                    </td>
                    <td>
                        <x-input-error :messages="$errors->get('countryTwo')" class="mt-2" />
                    </td>
                </tr>
                <tr>
                    <td>
                       <span class="text-gray-600 font-light text-xl "> Data rozgrywki meczu</span>

                    </td>
                    <td>
                        <input id="date" type="date" name="date" autocomplete="family-name" maxlength="200"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('date') }}" />
                        <input id="time" type="time" name="time" autocomplete="family-name" maxlength="200"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('time') }}" />
                    </td>
                </tr>

                <tr>
                    <td class="py-4">

                    </td>
                    <td>
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </td>
                </tr>
                <tr>
                    <td>
                       <span class="text-gray-600 font-light text-xl "> Wynik meczu opcjonalnie</span>

                    </td>
                    <td >
                        <input  type="number" name="resultOne" autocomplete="family-name" max="300" min="0" step="1"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOne') }}" />
                        <input  type="number" name="resultTwo" autocomplete="family-name" max="300" min="0" step="1"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultTwo') }}" />
                    </td>
                </tr>
                <tr>
                    <td class="py-4">

                    </td>
                    <td>
                        <x-input-error :messages="$errors->get('resultOne')" class="mt-2" />
                        <x-input-error :messages="$errors->get('resultTwo')" class="mt-2" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            value="DODAJ">

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </td>
                </tr>


            </table>
        </form>
    </div>



</x-app-layout>
