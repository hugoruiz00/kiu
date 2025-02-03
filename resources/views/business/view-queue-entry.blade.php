<x-main-view>
  <div class="mt-5">
    <div class="w-full sm:max-w-2xl py-3 px-6 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg relative">
        <x-back-button href="{{route('business.public_active_clients', $queue_entry->business)}}"/>

        <section class="flex flex-col justify-center items-center py-3">
            <!-- Información del cliente -->
            <p class="text-xl font-semibold text-gray-800 text-center">
                <strong>{{ $queue_entry->queue_client->name }}</strong>, estás registrado
            </p>
        
            <!-- Posición en la cola -->
            <p class="text-lg text-gray-700 text-center mt-2">
                Eres el número <strong class="text-black" id="position-number">{{ $queue_entry->position_number }}</strong> 
                en la cola de espera de <strong class="text-gray-900">{{ $queue_entry->business->name }}</strong>
            </p>
        
            <!-- Código -->
            <div class="bg-blue-100 text-dang-800 rounded-md p-4 mt-4 mb-6 text-center">
                <p class="text-lg font-medium">
                    Código: <strong class="text-orange-600">{{ $queue_entry->code }}</strong>
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    Guarda este código para consultar tu información después.
                </p>
            </div>
        
              
            <x-input-error :messages="$errors->get('code')" class="" />
            <x-secondary-button class="my-2" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-queue-entry')">
                {{ __('Cancelar turno') }}
            </x-secondary-button>

            <x-modal name="confirm-delete-queue-entry" maxWidth="md">
              <div class="px-5 py-6 text-center">
                  <form action="{{route('business.cancel_queue_entry', $queue_entry)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="code" value="{{$queue_entry->code}}">
                    
                    <p class="text-gray-700 my-2">
                      ¿Estás seguro de que deseas cancelar tu turno?
                    </p>
                    <p>Perderás tu lugar en la cola</p>
                    
                    <x-secondary-button class="mt-5" x-on:click="show=!show">
                      {{ __('Seguir en la cola') }}
                    </x-secondary-button>
                    <x-primary-button class="mt-5" type="submit">
                        {{ __('Cancelar turno') }}
                    </x-primary-button>
                  </form>
              </div>
          </x-modal>
        </section>
    </div>
  </div>

  <script type="module">
    const business_id = @json($queue_entry->business->id);
    const queue_entry_id = @json($queue_entry->id);

    Echo.channel(`business.${business_id}`).listen('QueueUpdated', (e) => {
      const updated_entry = e.queue_entries.find(entry => entry.id === queue_entry_id);
      
      if (updated_entry) {
        const positionElement = document.getElementById('position-number');
        if (positionElement) {
          positionElement.textContent = updated_entry.position_number;
        }
      }
    }).error((error) => {
      console.error('Error connecting to channel:', error);
    });
  </script>
</x-main-view>