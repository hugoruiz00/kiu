<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col justify-center items-center h-[calc(100vh-4rem)] px-3">
        <x-application-logo class="fill-current" width="150"/>

        <div class="flex flex-col items-center text-center">
            <h1 class="my-4 text-4xl font-bold text-[#FF5C00]">Administra la cola en tu negocio de forma fácil</h1>
            <div>
                <a href="{{route('loginprovider', 'google')}}" class="h-14 mt-5 font-bold shadow-lg shadow-[#8b8b8b] inline-flex items-center px-4 py-2 bg-[#FFFFFF] border border-transparent rounded-md text-xs text--[#616161] uppercase tracking-widest hover:bg-[#dfdfdf] active:bg-[#dfdfdf] focus:outline-none ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <x-icons.google-logo width="25"/>
                    <span class='ml-3'>Ingresa con tu cuenta de Google</span>
                </a>
                <p class="text-xs mt-4 mb-4 text-gray-600">
                    Al ingresar, aceptas los
                    <a target="_" href="{{route('terms_service')}}" class="underline">
                        Términos del servicio
                    </a>
                    y confirmas que has leído la
                    <a target="_" href="{{route('privacy_policy')}}" class="underline">
                        Política de privacidad
                    </a>
                    .
                </p>
            </div>
            <p class="my-4 text-2xl text-[#5F5F5F]">
                Permite a tus clientes colocarse en la cola virtual <br/> desde <span class="font-bold">cualquier lugar</span> y <span class="font-bold"> de forma rápida</span>
            </p>
        </div>
    </div>

    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-app-layout>
