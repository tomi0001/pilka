<x-app-layout>
    <div class="main-page-countries">


        @if ($listCountry->isEmpty())
            <p class="text-red-500 font-light text-xl mt-4">Brak państw.</p>
        @else
            <div class="grid  grid-cols-2 gap-2">



                        @foreach ($listCountry as $country)


                                <div class="bg-blue-100 text-blue-800 px-4 py-2 ">{{ $country->name }}</div> <div class="bg-blue-100 text-blue-800 px-4 py-2 ">Grupa {{ \App\Http\Repositories\ProfileRepository::showNameGroup($country->id)->name }}</div>

                        @endforeach


            </div>
        @endif
</x-app-layout>
