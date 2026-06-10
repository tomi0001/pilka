<x-app-layout>

    @section ('title')
        Przeglądaj Grupę
    @endsection
    <div class="main-page-view">
        <p class="text-red-500 font-light text-xl mt-4 flex items-center justify-center">Nie ma żadnych grup, dodaj
            grupę..</p>

        @if (count($listOldGroup) > 0)
            <div class="text-blue-500 font-light text-xl mt-4 flex items-center justify-center">Istnieją starsze grupy,
                możesz je przeglądać.</div>

            @include('profile.selectOldGroup', ['route' => 'profile.showGroup'])
        @endif
    </div>
</x-app-layout>
