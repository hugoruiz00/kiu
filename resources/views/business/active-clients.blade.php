<x-main-view>
  <div class="mt-5"  
        x-data="{ 
            queue_entries: @js($queue_entries), 
            business_id: @js($business->id),
        }" 
        x-init="
            Echo.channel(`business.${business_id}`).listen('QueueUpdated', (e) => {
                queue_entries = e.queue_entries;
            });
        "
        >

    <x-session-status class="mx-auto mt-2 max-w-lg" :status="session('status')" :message="session('message')" />

    <template x-for="(item, index) in queue_entries" :key="item.id">
        <div class="w-full sm:max-w-2xl my-3 py-3 px-6 mx-auto bg-white shadow-lg overflow-hidden sm:rounded-lg flex justify-between items-center">
            <div class="flex">
                <p class="mr-5" x-text="index+1"></p>
                <p x-text="item.queue_client.name"></p>
            </div>
            <form :action="'{{route('business.attend_queue_entry', ':item')}}'.replace(':item', item.id)" method="POST">
                @csrf
                @method('PATCH')
                <x-primary-button title="Marcar como atendido" class="!p-1">
                    @svg('ph-user-check', 'text-white h-5 w-5')
                </x-primary-button>
            </form>
        </div>
    </template>

    <template x-if="queue_entries.length === 0">
        <div class="w-full sm:max-w-lg py-3 px-6 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg">
            <section class="flex flex-col justify-center items-center">
                @svg('ph-users', 'text-gray-500 h-20 w-20')
                <p class="my-6 text-xl text-gray-500 text-center mx-3">
                    No tienes clientes esperando en la cola
                </p>
            </section>
        </div>
    </template>

    <x-primary-button
        title="Agregar cliente"
        x-data=""
        class="!rounded-full !p-3 fixed bottom-10 right-10"
        x-on:click.prevent="$dispatch('open-modal', 'add-queue-entry')"
    >
        @svg('ph-plus', 'text-white h-8 w-8')
    </x-primary-button>

    {{-- Add new client --}}
    <x-modal name="add-queue-entry" maxWidth="md" :show="!empty($errors->get('name'))">
        <div class="px-5 py-8 text-center">
            <form action="{{route('business.add_queue_entry', $business)}}" method="POST">
                @csrf
                <p class="mb-3">Agregar cliente</p>
                <div>
                    <x-input-label for="name" :value="__('Nombre del cliente *')" class="text-left"/>
                    <x-text-input id="name" placeholder="Nombre" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <x-primary-button class="mt-4">
                    {{ __('Aceptar') }}
                </x-primary-button>
            </form>
        </div>
    </x-modal>

    {{-- Client added --}}
    @if (session('code-queue-entry'))
        <x-modal name="added-queue-entry" maxWidth="md" :show="true">
            <div class="px-5 py-8 text-center">
                <p class="font-bold">Cliente registrado en la cola</p>
                <p class="mt-4 mb-1">Código <strong>{{session('code-queue-entry')}}</strong></p>
                <p class="text-gray-700 text-sm">
                    Tu cliente puede consultar su información con este código
                </p>
                
                <x-primary-button class="mt-6" x-on:click="show=!show">
                    {{ __('Aceptar') }}
                </x-primary-button>
            </div>
        </x-modal>
    @endif

  </div>
</x-main-view>