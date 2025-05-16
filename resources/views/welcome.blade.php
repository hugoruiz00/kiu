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
                    placeholder="Buscar negocio..."/>
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
                @if (Auth::user())
                    <section class="flex flex-col justify-center items-center h-[calc(100vh-20rem)]">
                        @svg('ph-storefront', 'text-gray-500 h-24 w-24 mt-6')
                        <p class="my-6 text-xl text-gray-500 text-center mx-3">
                            Busca un negocio por su nombre para hacer cola o consultar tu turno
                        </p>
                        {{-- @if (!Auth::user())
                            <p class="my-6 text-xl text-gray-500 text-center mx-3">
                                O presiona el botón de 'Tengo un negocio' para administrar la cola en tu negocio
                            </p>
                        @endif --}}
                    </section>
                @else
                    <div>
                        <section class="bg-gray-100 py-10">
                            <div class="max-w-5xl mx-auto text-center px-4">
                                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                                    Gestiona tus colas sin estrés ni papelitos
                                </h1>
                                <p class="text-lg text-gray-700 mb-8">
                                    Crea una cola virtual para tu negocio en minutos. Tus clientes se registran desde su teléfono y tú los atiendes con orden y tranquilidad.
                                </p>
                                <div class="flex justify-center items-center gap-5">
                                    <a href="{{ route('login') }}" class="bg-[#FF5C00] text-white px-6 py-3 rounded-lg text-lg hover:bg-[#FF7C00]">
                                        Empieza gratis ahora
                                    </a>
                                    <a href="#como-funciona" class="text-[#FF5C00] hover:underline text-lg">
                                        Ver cómo funciona
                                    </a>
                                </div>
                            </div>
                        </section>

                        <!-- Benefits -->
                        <section class="py-16">
                            <div class="max-w-6xl mx-auto px-4 text-center">
                                <h2 class="text-3xl font-bold mb-10 text-gray-800">¿Por qué usar Colas Virtuales?</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                                    <div>
                                        <span class="text-4xl">📱</span>
                                        <p class="mt-4 text-gray-700">Tus clientes se registran desde su teléfono, sin descargar nada y sin tener que esperar de pie.</p>
                                    </div>
                                    <div>
                                        <span class="text-4xl">🕒</span>
                                        <p class="mt-4 text-gray-700">Menos espera física, más comodidad para todos.</p>
                                    </div>
                                    <div>
                                        <span class="text-4xl">👨‍💼</span>
                                        <p class="mt-4 text-gray-700">Controla el flujo de atención desde un panel simple.</p>
                                    </div>
                                    <div>
                                        <span class="text-4xl">📊</span>
                                        <p class="mt-4 text-gray-700">Visualiza la cola en tiempo real.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- How it works -->
                        <section id="como-funciona" class="py-16">
                            <div class="max-w-5xl mx-auto px-4 text-center">
                                <h2 class="text-3xl font-bold text-gray-800 mb-10">¿Cómo funciona?</h2>
                                <div class="grid md:grid-cols-3 gap-8 text-left">
                                    <div class="bg-white p-6 rounded-lg shadow">
                                        <h3 class="text-xl font-semibold mb-2">1. Crea tu cuenta</h3>
                                        <p class="text-gray-600">En segundos, desde cualquier dispositivo, totalmente gratis.</p>
                                    </div>
                                    <div class="bg-white p-6 rounded-lg shadow">
                                        <h3 class="text-xl font-semibold mb-2">2. Comparte tu cola</h3>
                                        <p class="text-gray-600">Tus clientes se registran con un enlace o código QR.</p>
                                    </div>
                                    <div class="bg-white p-6 rounded-lg shadow">
                                        <h3 class="text-xl font-semibold mb-2">3. Atiende fácilmente</h3>
                                        <p class="text-gray-600">Gestiona la cola desde tu panel y marca como atendidos.</p>
                                    </div>
                                </div>
                                
                                <!-- Video Demo -->
                                <div class="mt-5">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <iframe class="w-full h-96 rounded-lg shadow-lg"
                                                src="https://www.youtube.com/embed/ASS_39MvHNM"
                                                title="Demo Colas Virtuales"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>

                            </div>
                        </section>


                        <!-- Frequent questions -->
                        <section class="py-16">
                            <div class="max-w-4xl mx-auto px-4">
                                <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Preguntas frecuentes</h2>
                                <div x-data="{ open: null }" class="space-y-6">
                                    <div @click="open === 1 ? open = null : open = 1" class="cursor-pointer border p-4 rounded bg-white">
                                        <h3 class="font-semibold">¿Cuánto cuesta?</h3>
                                        <p x-show="open === 1" x-transition class="text-gray-600 mt-2">Es gratis por ahora y siempre habrá una versión gratuita disponible. Más adelante añadiremos funciones premium opcionales.</p>
                                    </div>
                                    <div @click="open === 2 ? open = null : open = 2" class="cursor-pointer border p-4 rounded bg-white">
                                        <h3 class="font-semibold">¿Mis clientes necesitan una app?</h3>
                                        <p x-show="open === 2" x-transition class="text-gray-600 mt-2">No, solo necesitan un navegador. Tú les das el enlace o código QR.</p>
                                    </div>
                                    <div @click="open === 3 ? open = null : open = 3" class="cursor-pointer border p-4 rounded bg-white">
                                        <h3 class="font-semibold">¿Puedo pausar la cola cuando quiera?</h3>
                                        <p x-show="open === 3" x-transition class="text-gray-600 mt-2">Sí, puedes activar o pausar la cola desde tu panel en cualquier momento.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- CTA -->
                        <section class="bg-[#FF5C00] py-16 text-white text-center max-w-6xl mx-auto">
                            <div class="">
                                <h2 class="text-3xl font-bold mb-4">¿Listo para mejorar la atención en tu negocio?</h2>
                                <p class="mb-8">Empieza gratis y prueba Colas Virtuales hoy mismo.</p>
                                <a href="{{ route('login') }}" class="bg-white text-[#FF5C00] font-semibold px-6 py-3 rounded-lg text-lg hover:bg-gray-200">
                                    Crear cuenta gratis
                                </a>
                            </div>
                        </section>
                    </div>                    
                @endif
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