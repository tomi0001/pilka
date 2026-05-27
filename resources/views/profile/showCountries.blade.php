<x-app-layout>
    <div class="main-page-countries">
        @if (count($listOldGroup) > 0)
                <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

                @include('profile.selectOldGroup', ['route' => 'profile.showCountries'])

        @endif

        @if ($listCountry->isEmpty())
            <p class="text-red-500 font-light text-xl mt-4">Brak państw.</p>
        @else
            <div class="grid  grid-cols-3 gap-2">



                        @foreach ($listCountry as $country)


                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">{!! "<a href='" . route('profile.showCountriesId', ['id' => $country->id]) . "'>" . $country->name . "</a>"   !!}</div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">
                                    <span @class([
                                        'font-bold',
                                        'text-red-500' => \App\Http\Repositories\ProfileRepository::showNameGroup($country->id,session()->get('oldGroup')) == null,
                                        'text-blue-500' => ! \App\Http\Repositories\ProfileRepository::showNameGroup($country->id,session()->get('oldGroup')) == null,
                                    ])>
                                     {!!    \App\Http\Repositories\ProfileRepository::showNameGroup($country->id,session()->get('oldGroup')) == null ?
                                     "Nie przypisano do grupy" :
                                      " <a href='" . route('profile.showGroupForm', ['group' => \App\Http\Repositories\ProfileRepository::showNameGroup($country->id,session()->get('oldGroup'))->group_id]) . "'> Grupa " . \App\Http\Repositories\ProfileRepository::showNameGroup($country->id,session()->get('oldGroup'))->name . "</a>" !!}
                                     </span>
                                </div>
                                <div class="bg-blue-100 text-blue-800 px-4 py-2">
                                    liczba meczy {{ \App\Http\Repositories\ProfileRepository::countGames($country->id,session()->get('oldGroup') ) }}
                                </div>
                        @endforeach


            </div>
        @endif
</x-app-layout>
