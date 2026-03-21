<x-app-layout>
    <div class="main-page-add">
        <form action="{{ route('profile.showGroupForm') }}" method="get" id="showGroup">

            <select name="group" id="group" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" onchange="document.getElementById('showGroup').submit()">
                @foreach ($listGroup as $group)
                    @if ($group->id == $selectedGroup)
                        <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                    @else
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endif
                @endforeach
            </select>
        </form>

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
                @for($i=0;$i < count($arrayPtk); $i++)
                    <tr>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['name'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['PTK'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['RM'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['BZ'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['BS'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['RB'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['W'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['P'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['R'] }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    @endif

    </div>



</x-app-layout>
