<x-app-layout>
    <div class="main-page-add">
        <form action="{{ route('profile.addCountrySubmit') }}" method="get">

            <table class="table-auto w-full border-collapse">
                <tr>
                    <td class="px-8">
                        <span class="text-gray-600 font-light text-xl "> Nazwa Kraju</span>
                    </td>
                    <td >
                        <input id="name" type="text" name="name" autocomplete="family-name" maxlength="200"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />

                    </td>
                </tr>
                <tr>
                    <td>
                       <span class="text-gray-600 font-light text-xl "> Do jakiej grupy <br>chcesz dodać kraj? </span>

                    </td>
                    <td class="py-6">
                        <select name="group" id="group" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Narazie nie dodawaj</option>
                            @foreach ($listGroup as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
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
