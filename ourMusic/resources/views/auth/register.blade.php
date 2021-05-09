<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <h1>Registro</h1>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="edad" value="{{ __('Edad') }}" />
                <x-jet-input id="edad" class="block mt-1 w-full" type="number" name="edad" :value="old('edad')" required autofocus autocomplete="edad" />
            </div>

            <div class="mt-4">
                <x-jet-label for="localizacion" value="{{ __('Localización') }}" />
                <x-jet-input id="localizacion" class="block mt-1 w-full" type="text" name="localizacion" :value="old('localizacion')" required autofocus autocomplete="localizacion" />
            </div>

            <div class="mt-4">
                <x-jet-label for="biografia" value="{{ __('Biografía') }}" />
                <textarea id="biografia" class="block mt-1 w-full" name="biografia" :value="old('biografia')" autofocus autocomplete="biografia"></textarea>
            </div>

            <div class="mt-4">
                <x-jet-label for="favoritos" value="{{ __('Artistas favoritos') }}" />
                <textarea id="favoritos" class="block mt-1 w-full" name="favoritos" :value="old('favoritos')" autofocus autocomplete="favoritos"></textarea>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('Estoy de acuerdo con los :terms_of_service y la :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Términos del Servicio').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Política de Privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Iniciar sesión') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
