<x-main-view>
  <div class="mt-5">

    <div class="w-full sm:max-w-lg mx-auto py-6 px-8 bg-white shadow-lg rounded-lg space-y-6">
      <!-- Switch para estado del negocio con descripción clara -->
      <div
        x-cloak
        x-data="{ isOpen: {{ $business->is_open ? 'true' : 'false' }} }"
        class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-lg shadow-sm"
      >
          <div>
              <p class="text-lg font-medium text-gray-800"
                x-text="isOpen ? 'Negocio Abierto' : 'Negocio Cerrado'">
              </p>

              <p class="text-sm text-gray-600" x-show="isOpen">
                Los clientes ya pueden registrarse en la cola.
              </p>
              <p class="text-sm text-gray-600" x-show="!isOpen">
                El negocio está cerrado. Ábrelo para permitir el registro de clientes en la cola.
              </p>
          </div>
          
          <form method="POST" action="{{route('business.toggle_status', $business)}}" x-ref="toggleForm">
              @csrf
              @method('POST')
      
              <input type="hidden" name="is_open" :value="isOpen">
              <label class="inline-flex items-center cursor-pointer">
                  <input 
                      type="checkbox" 
                      class="sr-only peer" 
                      @checked($business->is_open)
                      @change="isOpen = !isOpen; $refs.toggleForm.submit();"
                  >
                  <div class="relative w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-orange-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
              </label>
          </form>
        
      </div>
  
      <!-- Código QR y enlace compartido -->
      <div class="bg-gray-100 px-4 py-4 rounded-lg shadow-sm text-center">
          <p class="text-sm font-medium text-gray-800 mb-3">
              Tus clientes pueden registrarse escaneando este código QR o usando el siguiente enlace:
          </p>
          <div class="flex justify-center items-center mb-4">
              {!! $qr_code !!}
          </div>
          <p class="text-sm text-gray-600 break-all">
              <a 
                  href="{{ route('business.public_active_clients', $business) }}" 
                  target="_blank" 
                  class="text-orange-600 hover:underline"
              >
                  {{ route('business.public_active_clients', $business) }}
              </a>
          </p>
      </div>
  
      <!-- Botones de compartir -->
      <div class="flex flex-col sm:flex-row justify-center gap-4">
          <button 
              type="button" 
              class="px-4 py-2 w-full text-sm font-medium text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-300 focus:outline-none"
              x-data
              x-on:click="
                  if (navigator.share) {
                      navigator.share({
                          title: 'Regístrate en la cola de espera de {{ $business->name }} con este enlace: {{ route('business.public_active_clients', $business) }}',
                          text: 'Usa este enlace para registrarte.',
                          url: '{{ route('business.public_active_clients', $business) }}'
                      }).catch(error => console.error('Error al compartir:', error));
                  } else {
                      $clipboard('{{ route('business.public_active_clients', $business) }}');
                      alert('Enlace copiado al portapapeles.');
                  }
              "
          >
              Compartir Enlace
          </button>
      </div>
  </div>
  
  


  </div>
</x-main-view>