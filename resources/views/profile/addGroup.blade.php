<x-app-layout>
    <div class="main-page-add">
        <form action="{{ route('profile.addGroupSubmit') }}" method="get">

            <table class="table-auto w-full border-collapse">
                <tr>
                    <td class="px-8">
                        <span class="text-gray-600 font-light text-xl "> Nazwa grupy</span>
                    </td>
                    <td class="py-6">
                        <input id="name" type="text" name="name" autocomplete="family-name" maxlength="1"
                            style="text-transform: uppercase;"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />

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