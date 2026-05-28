<x-app-layout>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>




                        <form action="{{ route('profile.addGameSubmit') }}" method="post" class="mt-6 space-y-6">
                            @csrf

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
                                <select name="status" id="type" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                @if (Auth::user()->status == -1)
                                                    <option value="-1" @selected(old('status') == '-1' ? true : false)>Mecz o punkty</option>
                                                @elseif (Auth::user()->status == 64)
                                                    <option value="64" @selected(old('status') == '64' ? true : false)>Mecz o 1/64 pucharu</option>
                                                @elseif (Auth::user()->status == 32)
                                                    <option value="32" @selected(old('status') == '32' ? true : false)>Mecz o 1/32 pucharu</option>
                                                @elseif (Auth::user()->status == 16)
                                                    <option value="16" @selected(old('status') == '16' ? true : false)>Mecz o 1/16 pucharu</option>
                                                @elseif (Auth::user()->status == 8)
                                                    <option value="8" @selected(old('status') == '8' ? true : false)>Mecz o 1/8 pucharu</option>
                                                @elseif (Auth::user()->status == 4)
                                                    <option value="4" @selected(old('status') == '4' ? true : false)>Mecz o 1/4 pucharu</option>
                                                @elseif (Auth::user()->status == 2)
                                                    <option value="2" @selected(old('status') == '2' ? true : false)>Mecz o 1/2 pucharu</option>
                                                @elseif (Auth::user()->status == 1)
                                                    <option value="1" @selected(old('status') == '1' ? true : false)>Mecz o 3 miejsce</option>
                                                    <option value="0" @selected(old('status') == '0' ? true : false)>Finał</option>
                                                @elseif (Auth::user()->status == 0)
                                                    <option value="0" @selected(old('status') == '0' ? true : false)>Finał</option>
                                                @endif
                                                <option value="-2" @selected(old('status') == '-2' ? true : false)>Mecz towarzyski</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />

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
                            @if (Auth::user()->status >=  0)
                                <div>
                                    <span class="text-gray-600 font-light text-x2 "> Wynik Dogrywki opcjonalnie</span>
                                    <input  type="number" name="result_over_one" autocomplete="family-name" max="255" min="0" step="1"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('result_over_one') }}" />
                                    <input  type="number" name="result_over_two" autocomplete="family-name" max="255" min="0" step="1"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('result_over_two') }}" />

                                    <x-input-error :messages="$errors->get('result_over_one')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_over_two')" class="mt-2" />
                                </div>
                                <div>
                                    <span class="text-gray-600 font-light text-x2 "> Wynik Rzutów karnych opcjonalnie</span>
                                    <input  type="number" name="result_pena_one" autocomplete="family-name" max="255" min="0" step="1"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('result_pena_one') }}" />
                                    <input  type="number" name="result_pena_two" autocomplete="family-name" max="255" min="0" step="1"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  value="{{ old('result_pena_two') }}" />

                                    <x-input-error :messages="$errors->get('result_pena_one')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_pena_two')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('result_error')" class="mt-2" />
                                </div>
                            @endif
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
