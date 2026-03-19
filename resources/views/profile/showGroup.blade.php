<x-app-layout>
    <div class="main-page-add">
        <select name="group" id="group" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            @foreach ($listGroup as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>

    @if ($listCountry->isEmpty())
        <p class="text-red-500 font-light text-xl mt-4">Brak krajów w tej grupie.</p>
    @else
        <table class="table-auto w-full border-collapse mt-4">
            <thead>
                <tr>
                    <th class="px-8 py-4 text-left text-gray-600 font-light text-xl">Kraj</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCountry as $country)
                    <tr>
                        <td class="px-8 py-4">{{ $country->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    </div>



</x-app-layout>
