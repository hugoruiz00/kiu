<x-main-view>
  <div class="mt-5" 
        x-data="{ 
            queue_entries: @js($queue_entries), 
            business_id: @js($business->id),
            is_open: @js($business->is_open),
        }" 
        x-init="
            Echo.channel(`business.${business_id}`).listen('QueueUpdated', (e) => {
                queue_entries = e.queue_entries;
            });
        "
    >

    <x-session-status class="mx-auto mb-2 max-w-xl" :status="session('status')" :message="session('message')" />
      
    <div class="w-full sm:max-w-2xl py-3 px-6 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg relative">
        <x-back-button href="{{route('home', ['search' => $business->name])}}"/>

        <section class="flex flex-col justify-center items-center">
            @if (!$business->is_open)
                <div class="w-full bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 mb-3 mt-8 rounded relative">
                    <span class="block sm:inline">El negocio <span class="font-bold">{{$business->name}}</span> está cerrado en este momento.</span>
                    <span class="block text-sm mt-2">Podrás registrarte cuando vuelva a abrir.</span>
                </div>
            @endif

            <p class="text-lg text-gray-700 text-center mx-3" x-show="queue_entries.length > 0">
                Hay <span x-text="queue_entries.length"></span> personas haciendo cola en <span class="font-bold">{{$business->name}}</span>
            </p>
            <p class="text-lg text-gray-700 text-center mx-3 mb-2" x-show="queue_entries.length === 0">
                No hay personas en espera en <span class="font-bold">{{$business->name}}</span>
            </p>
            
            <template x-if="is_open">
                <x-primary-button class="my-3" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-queue-entry')">
                    {{ __('Unirse a la cola') }}
                </x-primary-button>
            </template>

            <template x-if="queue_entries.length > 0">
                <p class="text-lg text-gray-700 text-center mx-3 pt-2">
                    Consulta tu turno si ya estás registrado
                </p>
            </template>

            <x-modal name="add-queue-entry" maxWidth="md" :show="!empty($errors->get('name'))">
                <div class="px-5 py-8 text-center">
                    <form action="{{route('business.public_add_queue_entry', $business)}}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Escribe tu nombre *')" class="text-left"/>
                            <x-text-input id="name" placeholder="Nombre" class="block mt-1 w-full" type="text" name="name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <x-primary-button class="mt-4">
                            {{ __('Aceptar') }}
                        </x-primary-button>
                    </form>
                </div>
            </x-modal>

        </section>
    </div>
    
    <div x-data="{queue_entry_id: @js(old('queue_entry_id'))}">
        <template x-for="(item, index) in queue_entries" :key="item.id">
            <div class="w-full sm:max-w-2xl my-3 py-3 px-6 mx-auto bg-white shadow-lg overflow-hidden sm:rounded-lg flex justify-between items-center">
                <div class="flex">
                    <p class="mr-5" x-text="index+1"></p>
                    <p x-text="item.queue_client.name"></p>
                </div>

                <x-primary-button
                    x-data=""
                    x-on:click.prevent="queue_entry_id = item.id; $dispatch('open-modal', 'ask-code-queue-entry')"
                >
                    Ver
                </x-primary-button>
            </div>
        </template>

        <x-modal name="ask-code-queue-entry" maxWidth="md" :show="!empty($errors->get('code'))"
        >
            <div class="px-5 py-8 text-center">
                <form
                    :action="`{{ route('business.view_queue_entry', ':queue_entry_id') }}`.replace(':queue_entry_id', queue_entry_id)"
                    method="GET"
                >
                    @csrf
                    <div>
                        <x-input-label for="code" :value="__('Ingresa tu código *')" class="text-left"/>
                        <x-text-input id="code" placeholder="Código" class="block mt-1 w-full" type="text" name="code" required autofocus />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <input type="hidden" name="queue_entry_id" x-model="queue_entry_id">

                    <x-primary-button class="mt-4">
                        {{ __('Aceptar') }}
                    </x-primary-button>
                </form>
            </div>
        </x-modal>
    </div>
  </div>
</x-main-view>