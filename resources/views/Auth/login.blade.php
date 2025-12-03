@extends('layouts.app')

@section('title', 'Login - Tryout UTBK')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center">
                @php
                    $siteIcon = \App\Models\Setting::getValue('site_icon');
                @endphp
                @if($siteIcon)
                    <img src="{{ asset('storage/' . $siteIcon) }}" alt="Logo" class="h-12 w-12 object-contain">
                @else
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                @endif
            </div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-gray-900">
                {{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK System') }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Masuk ke akun Anda untuk melanjutkan
            </p>
        </div>
        <form class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-sm border border-gray-200" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="appearance-none relative block w-full px-4 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 focus:z-10 sm:text-sm @error('email') border-red-500 @enderror" 
                        placeholder="nama@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="appearance-none relative block w-full px-4 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 focus:z-10 sm:text-sm @error('password') border-red-500 @enderror" 
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 text-gray-900 focus:ring-gray-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ingat saya
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    Masuk
                </button>
            </div>

            @if(\App\Models\Setting::getValue('registration_enabled', true))
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-2">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-gray-900 hover:text-gray-700">
                        Daftar di sini
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection

