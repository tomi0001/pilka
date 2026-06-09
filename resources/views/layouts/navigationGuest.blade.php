<nav x-data="{ open: false }" class="bg-blue-400 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->


                <!-- Navigation Links -->

                <div class="sm:space-x-5 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('guest.showGroup')" :active="request()->routeIs('guest.showGroup')">
                        Lista grup
                    </x-nav-link>
                    <x-nav-link :href="route('guest.showCountries')" :active="request()->routeIs('guest.showCountries')">
                        Lista Państw
                    </x-nav-link>
                    <x-nav-link :href="route('guest.showCup')" :active="request()->routeIs('guest.showCup')">
                        faza pucharowa
                    </x-nav-link>
                    @if (\App\Models\User::exists())
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Logowanie') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Rejestracja') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>





        </div>
    </div>

</nav>
