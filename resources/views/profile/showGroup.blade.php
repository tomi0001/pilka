<x-app-layout>
    <div class="main-page-view">
        <form action="{{ route('profile.showGroupForm') }}" method="get" id="showGroup">

            <select name="group" id="group" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 form-select-group" onchange="document.getElementById('showGroup').submit()">
                @foreach ($listGroup as $group)
                    @if ($group->id == $selectedGroup)
                        <option value="{{ $group->id }}" selected>Grupa {{ $group->name }}</option>
                    @else
                        <option value="{{ $group->id }}">Grupa {{ $group->name }}</option>
                    @endif
                @endforeach
            </select>
        </form>

    @if ($listCountry->isEmpty())
        <p class="text-red-500 font-light text-xl mt-4">Brak krajów w tej grupie.</p>
    @else
    <div class="overflow-hidden rounded-3xl relative overflow-x-auto bg-neutral-primary-soft shadow-md rounded-base border border-default">

         <table class="w-full text-sm text-left rtl:text-right text-body min-w-full border-collapse border" id="groupTable">
            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-blue-400">
                <tr>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(0)">Kraj</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">RM</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">W</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">R</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">P</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">BZ</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">BS</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">RB</th>
                    <th class="px-8 py-4 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700 table-href" onclick="sortByColumn(1)">PTK</th>
                </tr>
            </thead>
            <tbody  class="divide-y divide-gray-200">
                @for($i=0;$i < count($arrayPtk); $i++)
                    @if ($i < 2)
                        <tr class="bg-gray-100 border-bs-10 border-blue-500">
                    @else
                    <tr>
                    @endif
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['name'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['RM'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['W'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['R'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['P'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['BZ'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['BS'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['RB'] }}</td>
                        <td class="px-8 py-4">{{ $arrayPtk[$i]['PTK'] }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        </div>
    @endif

    </div>



</x-app-layout>
