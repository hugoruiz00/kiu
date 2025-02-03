<x-app-layout>
  <!-- Session Status -->
  <x-session-status class="mx-auto mt-2" :status="session('status')" :message="session('message')" />

  <div class="w-full sm:max-w-lg sm:mt-3 px-6 py-4 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg relative">
		@empty($business)
			<x-back-button href="{{route('home')}}"/>
		@else
			<x-back-button href="{{route('business.active_clients', $business)}}"/>
		@endempty

		<form method="POST" action="{{ route('business.save') }}" enctype="multipart/form-data">
			@csrf

			<div class="text-center" x-data="fileUpload('{{empty($business->image) ? null : asset("storage/$business->image")}}')">

				<template x-if="previewImage">
					<img :src="previewImage" alt="Imagen seleccionada" class="mx-auto h-20 w-20 rounded-full object-cover">
				</template>
				<template x-if="!previewImage">
					@svg('ph-user-circle', 'h-20 w-20 text-gray-400 mx-auto')
				</template>

				<x-secondary-button class="!px-2 !py-1 mt-2" @click="$refs.fileInput.click()" 
					x-text="previewImage ? 'Cambiar imagen' : 'Agregar imagen'">
					{{-- {{ __('Agregar imagen') }} --}}
				</x-secondary-button>

				<input
					type="file"
					id="image-up"
					name="image"
					class="hidden"
					accept="image/*"
					x-ref="fileInput"
					@change="fileChosen"
				>
				<x-input-error :messages="$errors->get('image')" class="mt-2" />
			</div>

			<div class="mt-4">
				<x-input-label for="name" :value="__('Nombre de tu negocio *')" />
				<x-text-input id="name" placeholder="Nombre de tu negocio" class="block mt-1 w-full" type="text" name="name" :value="old('name', $business)" required />
				<x-input-error :messages="$errors->get('name')" class="mt-2" />
			</div>

			<div class="mt-4">
				<x-input-label for="business_category_id" :value="__('Tipo de negocio *')" />
				<select id="business_category_id" name="business_category_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-[#FF5C00] focus:border-[#FF5C00] block w-full p-2.5" required>
					<option selected disabled>Selecciona una opción</option>
					@foreach ($business_categories as $item)
						<option value="{{$item->id}}" @selected(old('business_category_id', $business) == $item->id)>
							{{$item->name}}
						</option>
					@endforeach
				</select>
				<x-input-error :messages="$errors->get('business_category_id')" class="mt-2" />
			</div>

			<div class="mt-4">
				<x-input-label for="estimated_service_time">
					Tiempo estimado de atención por cliente <small>(en minutos)</small> *
				</x-input-label>
				<x-text-input id="estimated_service_time" placeholder="Tiempo estimado de atención por cliente" class="block mt-1 w-full" type="number" name="estimated_service_time" :value="old('estimated_service_time', $business)" required />
				<x-input-error :messages="$errors->get('estimated_service_time')" class="mt-2" />
			</div>

			<div class="mt-4">
				<x-input-label for="phone_number" :value="__('Teléfono')" />
				<x-text-input id="phone_number" placeholder="Teléfono" class="block mt-1 w-full" type="number" name="phone_number" :value="old('phone_number', $business)" />
				<x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<x-primary-button>
					{{ __('Guardar') }}
				</x-primary-button>
			</div>
  	</form>
  </div>
  
  <script>
	  document.addEventListener('alpine:init', () => {
		  	Alpine.data('fileUpload', (initialImage = null) => ({
				previewImage: initialImage,
				fileChosen(event) {
					const file = event.target.files[0];
					if (file) {
						const reader = new FileReader();
						reader.onload = (e) => {
							this.previewImage = e.target.result;
						};
						reader.readAsDataURL(file);
					}
				}
		  }));
	  });
  </script>
</x-app-layout>