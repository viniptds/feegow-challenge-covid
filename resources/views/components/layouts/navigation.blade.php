<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="space-x-8 sm:ml-10 flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vaccines')" :active="request()->routeIs('vaccines')">
                        {{ __('Vaccines') }}
                    </x-nav-link>
                    <x-nav-link :href="route('workers')" :active="request()->routeIs('workers')">
                        {{ __('Workers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('workers.non-vaccinated-report')" :active="request()->routeIs('workers.non-vaccinated-report')">
                        {{ __('Relatório de Não-vacinados') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
