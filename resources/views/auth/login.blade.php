<x-guest-layout>
    <x-jet-authentication-card>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{--<span class="ml-2 text-3xl text-black text-center font-bold"><h1>Bienvenido a la Evaluación Docente</h1></span>--}}
            <span class="ml-2 text-base text-gray-600 text-center font-medium"><h3>Es muy importante para nosotros conocer tu opinión sobre la conducción de tus cursos.</h3></span>
            <span class="ml-2 text-base text-gray-600 text-center font-medium"><h4>Ingresa tu ID en usuario y en contraseña pones tu CURP para comenzar:</h4></span><br>

            <div>
                <x-jet-label value="{{ __('Usuario / ID pwc') }}" />
                <x-jet-input class="block mt-1 w-full" type="text"  placeholder="000008807" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!--olvido la contraseña
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            -->

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>

    </x-jet-authentication-card>
</x-guest-layout>
