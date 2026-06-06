<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>


                            <form action="{{ route('profile.addGroupSubmit') }}" method="post" class="mt-6 space-y-6">
                                @csrf


                                <div>
                                        <span class="text-gray-600 font-light text-x2 "> Nazwa grupy</span>

                                        <input id="name" type="text" name="name" autocomplete="family-name" maxlength="1"
                                                        style="text-transform: uppercase;"
                                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />

                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                </div>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Dodaj') }}</x-primary-button>


                                </div>
                                @if (session('success'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-center " role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif


                            </form>
                    </section>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
