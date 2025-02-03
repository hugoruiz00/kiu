<x-app-layout>
  <!-- Session Status -->
  <x-session-status class="mx-auto mt-2" :status="session('status')" :message="session('message')" />

  <div class="w-full sm:max-w-lg sm:mt-3 px-6 py-4 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg relative">
    <x-back-button href="{{route('home')}}"/>

    <div class="text-center mb-5 mt-3">
      <h1 class="text-lg mb-1">¿Tienes algún problema, queja o sugerencia?</h1>
      <p class="text-gray-600">Deja un comentario para tomarlo en cuenta</p>
    </div>

		<form method="POST" action="{{ route('comment.store') }}">
			@csrf

			<div class="mt-4">
				<x-input-label for="content" :value="__('Comentario *')" />
				<x-textarea-input rows="4" id="content" placeholder="Comentario" class="block mt-1 w-full" type="text" name="content" required>{{old('content')}}</x-textarea-input>
				<x-input-error :messages="$errors->get('content')" class="mt-2" />
			</div>

      <div class="mt-4">
        <x-input-label for="email">
					Correo <small>(opcional)</small>
				</x-input-label>
        <x-text-input id="email" placeholder="Correo" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

			<div class="mt-4">
				<x-input-label for="phone_number">
					Teléfono <small>(opcional)</small>
				</x-input-label>
				<x-text-input id="phone_number" placeholder="Teléfono" class="block mt-1 w-full" type="number" name="phone_number" :value="old('phone_number')" />
				<x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<x-primary-button>
					{{ __('Enviar') }}
				</x-primary-button>
			</div>
  	</form>
  </div>
  
</x-app-layout>