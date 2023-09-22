<x-guest-layout>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/login.css') }}">
    </head>
    <div class="container">
        <span class="textLogo">KLUBINHO</span>

        <div class="login">
            <div class="welcome">
                <p>
                    <span>Bem-vindo(a) ao </span>
                    <span>Klubinho</span>
                </p>

                    <p>
                        <span>Sem conta?</span>
                        <span><a href="/register">cadastre-se</a></span>
                    </p>
            </div>

            <p class="textLogin">Login</p>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="loginForm" action="" className={styles.loginForm}>
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif

                    <x-button class="ml-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>