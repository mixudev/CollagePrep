@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="flex-shrink-0 bg-gray-100 rounded-lg p-2.5">
                            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Pengaturan Sistem</h1>
                            <p class="text-sm text-gray-600 mt-0.5">Kelola pengaturan umum aplikasi</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-gray-50 border border-gray-200 text-gray-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="h-5 w-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Settings Form -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" data-confirm-submit="Apakah Anda yakin ingin menyimpan pengaturan?">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                @foreach($settings as $group => $groupSettings)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <!-- Section Header -->
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h2 class="text-base font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $group) }}</h2>
                            <p class="text-xs text-gray-600 mt-1">Pengaturan untuk {{ str_replace('_', ' ', $group) }}</p>
                        </div>
                        
                        <!-- Settings Content -->
                        <div class="p-6 space-y-6">
                            @foreach($groupSettings as $setting)
                                <div class="border-b border-gray-100 pb-5 last:border-b-0 last:pb-0">
                                    <div class="flex items-start justify-between gap-6">
                                        <div class="flex-1">
                                            <label class="block text-sm font-semibold text-gray-900 mb-1">
                                                {{ $setting->description ?? ucfirst(str_replace('_', ' ', $setting->key)) }}
                                            </label>
                                            @if($setting->description)
                                                <p class="text-xs text-gray-500 mt-1">{{ $setting->key }}</p>
                                            @endif
                                        </div>
                                        <div class="flex-shrink-0">
                                            @if($setting->type === 'file')
                                                <div class="space-y-3">
                                                    @if($setting->value)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('storage/' . $setting->value) }}" alt="Site Icon" class="w-16 h-16 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50">
                                                        </div>
                                                    @endif
                                                    <input type="file" 
                                                        name="site_icon_file" 
                                                        accept="image/png,image/jpeg,image/jpg,image/svg+xml"
                                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                                    <p class="text-xs text-gray-500">Format: PNG, JPG, SVG (max 2MB)</p>
                                                </div>
                                            @elseif($setting->type === 'color')
                                                <div class="space-y-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-shrink-0">
                                                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Pilih Warna</label>
                                                            <input type="color" 
                                                                name="settings[{{ $setting->key }}]" 
                                                                value="{{ $setting->value ?: ($setting->key === 'primary_color' ? '#111827' : '#f97316') }}"
                                                                class="w-16 h-16 rounded-lg border-2 border-gray-300 cursor-pointer shadow-sm hover:border-gray-400 transition-colors"
                                                                id="color-{{ $setting->key }}">
                                                        </div>
                                                        <div class="flex-1">
                                                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Kode Hex</label>
                                                            <div class="flex items-center space-x-2">
                                                                <span class="text-gray-500 font-mono text-sm">#</span>
                                                                <input type="text" 
                                                                    name="settings[{{ $setting->key }}]" 
                                                                    value="{{ str_replace('#', '', $setting->value ?: ($setting->key === 'primary_color' ? '#111827' : '#f97316')) }}"
                                                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 text-sm font-mono"
                                                                    pattern="^[A-Fa-f0-9]{6}$"
                                                                    placeholder="{{ str_replace('#', '', $setting->key === 'primary_color' ? '#111827' : '#f97316') }}"
                                                                    id="text-{{ $setting->key }}"
                                                                    maxlength="6">
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-1">Masukkan kode hex 6 digit (contoh: 111827)</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const colorInput = document.getElementById('color-{{ $setting->key }}');
                                                        const textInput = document.getElementById('text-{{ $setting->key }}');
                                                        const currentColor = '{{ $setting->value ?: ($setting->key === 'primary_color' ? '#111827' : '#f97316') }}';
                                                        
                                                        function updateColor(value) {
                                                            // Handle input with or without #
                                                            let hexValue = value.trim();
                                                            if (!hexValue.startsWith('#')) {
                                                                hexValue = '#' + hexValue;
                                                            }
                                                            
                                                            // Validate hex color
                                                            if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(hexValue)) {
                                                                // Convert 3-digit to 6-digit hex
                                                                const fullHex = hexValue.length === 4 
                                                                    ? '#' + hexValue[1] + hexValue[1] + hexValue[2] + hexValue[2] + hexValue[3] + hexValue[3]
                                                                    : hexValue;
                                                                
                                                                // Update inputs
                                                                colorInput.value = fullHex;
                                                                textInput.value = fullHex.replace('#', '').toUpperCase();
                                                                
                                                            }
                                                        }
                                                        
                                                        colorInput.addEventListener('input', function() {
                                                            updateColor(this.value);
                                                        });
                                                        
                                                        textInput.addEventListener('input', function() {
                                                            // Only allow hex characters
                                                            this.value = this.value.replace(/[^A-Fa-f0-9]/g, '').toUpperCase();
                                                            if (this.value.length <= 6) {
                                                                updateColor(this.value);
                                                            }
                                                        });
                                                        
                                                        textInput.addEventListener('paste', function(e) {
                                                            e.preventDefault();
                                                            const pasted = (e.clipboardData || window.clipboardData).getData('text');
                                                            const cleaned = pasted.replace(/[^A-Fa-f0-9]/g, '').substring(0, 6).toUpperCase();
                                                            this.value = cleaned;
                                                            updateColor(cleaned);
                                                        });
                                                        
                                                        // Initialize
                                                        updateColor(currentColor);
                                                    });
                                                </script>
                                            @elseif($setting->type === 'boolean')
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" 
                                                        name="settings[{{ $setting->key }}]" 
                                                        value="1"
                                                        {{ $setting->value == '1' || $setting->value == 'true' ? 'checked' : '' }}
                                                        class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-700"></div>
                                                </label>
                                            @elseif($setting->type === 'number')
                                                <input type="number" 
                                                    name="settings[{{ $setting->key }}]" 
                                                    value="{{ $setting->value }}"
                                                    class="w-40 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors">
                                            @elseif($setting->type === 'textarea')
                                                <textarea 
                                                    name="settings[{{ $setting->key }}]" 
                                                    rows="3"
                                                    class="w-80 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors resize-none">{{ $setting->value }}</textarea>
                                            @else
                                                <input type="text" 
                                                    name="settings[{{ $setting->key }}]" 
                                                    value="{{ $setting->value }}"
                                                    class="w-80 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('dashboard') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-white transition-colors font-medium">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors font-medium">
                        <span class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Pengaturan
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
