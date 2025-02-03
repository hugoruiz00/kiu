<x-app-layout>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
    <div class='flex'>
      <div class='w-full'>
        @auth
          <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
            <ul class="flex flex-wrap justify-evenly -mb-px">
              <li>
                <x-tab-link :href="route('business.active_clients', Auth::user()->business ?? -1)" :active="request()->routeIs('business.active_clients')">
                  Cola
                </x-tab-link>
              </li>
              {{-- <li>
                <x-tab-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                  Atendidos
                </x-tab-link>
              </li> --}}
              <li>
                <x-tab-link :href="route('business.manage', Auth::user()->business ?? -1)" :active="request()->routeIs('business.manage')">
                  Mi negocio
                </x-tab-link>
              </li>
              <li>
                <x-tab-link :href="route('home')" :active="request()->routeIs('home')">
                  Negocios
                </x-tab-link>
              </li>
            </ul>
          </div>    
        @endauth

        {{ $slot }}

      </div>
    </div>
  </div>
</x-app-layout>
