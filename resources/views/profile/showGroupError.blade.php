<x-app-layout>
    <div class="main-page-view">
        <p class="text-red-500 font-light text-xl mt-4">Nie ma żadnych grup, dodaj grupę..</p>

        @if (count($listOldGroup) > 0)
            <div class="text-blue-500 font-light text-xl mt-4">Istnieją starsze grupy, możesz je przeglądać.</div>

                @include('profile.selectOldGroup')

        @endif
    </div>
</x-app-layout>
