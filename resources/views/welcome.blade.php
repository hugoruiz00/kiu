<x-main-view>
    <div class="mt-5">
        <x-session-status class="mx-auto mb-2 max-w-lg" :status="session('status')" :message="session('message')" />
        <form class="flex justify-center items-center mx-2">   
            <label for="search" class="sr-only">Buscar</label>
            <div class="relative w-full sm:max-w-5xl">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    @svg('fa-search', 'text-gray-400 h-5 w-5')
                </div>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{$search ?? ''}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF5C00] focus:border-[#FF5C00] block w-full pl-10 p-2.5"
                    placeholder="Buscar negocios..."/>
                <button
                    type="button"
                    id="clearSearch"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none"
                    style="display: {{ empty($search) ? 'none' : 'flex' }};"
                >
                    @svg('ph-x', 'h-5 w-5')
                </button>
            </div>
            <button type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-[#FF5C00] rounded-lg border hover:bg-[#CF4D04]">Buscar</button>
        </form>
    
        @forelse ($businesses as $business)
            <section class="flex justify-between flex-wrap mt-3">
                <div class="w-full sm:max-w-2xl my-3 py-3 px-6 mx-auto bg-white shadow-lg overflow-hidden sm:rounded-lg flex justify-between items-center">
                    <div class="flex items-center justify-center">
                        @if (empty($business->image))
                            @svg('ph-user-circle', 'h-8 w-8 text-gray-400')
                        @else
                            <img class="h-8" src="{{asset("storage/$business->image")}}" alt="{{$business->name}}" title="{{$business->name}}">
                        @endif
                        <div class="ml-3">
                            <p>{{$business->name}}</p>
                            <p class="text-[#5F5F5F]">{{$business->business_category->name}}</p>
                        </div>
                    </div>
                    <x-primary-link :href="route('business.public_active_clients', $business)">
                        Ver
                    </x-primary-link>
                </div> 
            </section>
        @empty
            @empty($search)
                <section class="flex flex-col justify-center items-center h-[calc(100vh-20rem)]">
                    @svg('ph-storefront', 'text-gray-500 h-24 w-24 mt-6')
                    <p class="my-6 text-xl text-gray-500 text-center mx-3">
                        Busca un negocio por su nombre para hacer cola o consultar tu turno
                    </p>
                    @if (!Auth::user())
                        <p class="my-6 text-xl text-gray-500 text-center mx-3">
                            O presiona el botón de 'Tengo un negocio' para administrar la cola en tu negocio
                        </p>
                    @endif
                </section>
            @else
                <section class="flex flex-col justify-center items-center h-[calc(100vh-20rem)]">
                    @svg('gmi-search-off', 'text-gray-500 h-24 w-24 mt-6')
                    <p class="my-6 text-xl text-gray-500 text-center mx-3">
                        No se ha encontrado el negocio, pruebe con otro nombre
                    </p>
                </section>
            @endempty
        @endforelse
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("search");
            const clearButton = document.getElementById("clearSearch");
            const form = clearButton.closest("form");
    
            clearButton.addEventListener("click", function () {
                searchInput.value = "";
                form.submit();
            });
        });
    </script>
</x-main-view>