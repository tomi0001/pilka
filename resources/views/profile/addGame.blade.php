<x-app-layout>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>




                        <form action="{{ route('profile.addGameSubmit') }}" method="get" class="mt-6 space-y-6">


                            <div>
                                <span class="text-gray-600 font-light text-x2 "> Wybierz kraj gospodarz</span>

                                <select name="countryOne" id="countryOne" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                <option value=""></option>
                                                @foreach ($listCountry as $country)

                                                    <option value="{{ $country->id }}"  @selected(old('countryOne') == $country->id ? true : false)>{{ $country->name }}</option>
                                                @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('countryOne')" class="mt-2" />
                                <x-input-error :messages="$errors->get('countryOne1')" class="mt-2" />
                            </div>
                            <div>
                                <span class="text-gray-600 font-light text-x2 "> Wybierz kraj gościa</span>
                                <select name="countryTwo" id="countryTwo" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                <option value=""></option>
                                                @foreach ($listCountry as $country)

                                                    <option value="{{ $country->id }}"  @selected(old('countryTwo') == $country->id ? true : false)>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                <x-input-error :messages="$errors->get('countryTwo')" class="mt-2" />
                            </div>
                            <div>
                                <span class="text-gray-600 font-light text-x2 "> Data rozgrywki meczu</span>
                                <input id="date" type="date" name="date" autocomplete="family-name" maxlength="200"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('date') }}" />
                                <input id="time" type="time" name="time" autocomplete="family-name" maxlength="200"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('time') }}" />

                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                <x-input-error :messages="$errors->get('time')" class="mt-2" />
                            </div>
                            <div>
                                <span class="text-gray-600 font-light text-x2 "> Rodzaj meczu</span>
                                <select name="type" id="type" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            @if (Auth::user()->status == 0)
                                                    <option value="0" @selected(old('type') == '0' ? true : false)>Mecz o punkty</option>
                                                @else
                                                    <option value="1" @selected(old('type') == '1' ? true : false)>Mecz faza pucharowa</option>
                                                @endif
                                                <option value="2" @selected(old('type') == '2' ? true : false)>Mecz towarzyski</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />

                            </div>

                            <div>
                                <span class="text-gray-600 font-light text-x2 "> Wynik meczu opcjonalnie</span>
                                <input  type="number" name="resultOne" autocomplete="family-name" max="255" min="0" step="1"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultOne') }}" />
                                <input  type="number" name="resultTwo" autocomplete="family-name" max="255" min="0" step="1"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('resultTwo') }}" />

                                <x-input-error :messages="$errors->get('resultOne')" class="mt-2" />
                                <x-input-error :messages="$errors->get('resultTwo')" class="mt-2" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Dodaj') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Dodaj.') }}</p>
                                @endif
                            </div>

                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>
