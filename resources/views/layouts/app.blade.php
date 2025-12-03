<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', \App\Models\Setting::getValue('site_name', 'Tryout UTBK'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        $primaryColor = \App\Models\Setting::getValue('primary_color', '#111827');
        $secondaryColor = \App\Models\Setting::getValue('secondary_color', '#f97316');
        
        // Convert hex to RGB for opacity support
        function hexToRgb($hex) {
            $hex = str_replace('#', '', $hex);
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            return "$r, $g, $b";
        }
        $primaryRgb = hexToRgb($primaryColor);
        $secondaryRgb = hexToRgb($secondaryColor);
    @endphp
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --primary-rgb: {{ $primaryRgb }};
            --secondary-rgb: {{ $secondaryRgb }};
        }
        /* Minimal SweetAlert Styles */
        .minimal-swal-popup {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 0;
        }
        .minimal-swal-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.5rem;
        }
        .minimal-swal-content {
            color: #6b7280;
            font-size: 0.875rem;
        }
        .minimal-swal-confirm {
            background-color: var(--primary-color) !important;
            color: white !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 0.625rem 1.25rem !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: background-color 0.2s !important;
        }
        .minimal-swal-confirm:hover {
            background-color: rgba(var(--primary-rgb), 0.9) !important;
        }
        
        /* Dynamic color classes - Primary */
        .bg-primary,
        .bg-gray-900 {
            background-color: var(--primary-color) !important;
        }
        .hover\:bg-primary:hover,
        .hover\:bg-gray-800:hover {
            background-color: rgba(var(--primary-rgb), 0.9) !important;
        }
        .text-primary,
        button.bg-gray-900,
        a.bg-gray-900 {
            color: white !important;
        }
        .border-primary,
        .focus\:ring-gray-900:focus,
        .focus\:border-gray-900:focus {
            border-color: var(--primary-color) !important;
        }
        .focus\:ring-gray-900:focus {
            --tw-ring-color: var(--primary-color) !important;
        }
        
        /* Dynamic color classes - Secondary (for charts, badges, supporting elements) */
        .bg-secondary {
            background-color: var(--secondary-color) !important;
        }
        .text-secondary {
            color: var(--secondary-color) !important;
        }
        .border-secondary {
            border-color: var(--secondary-color) !important;
        }
        
        /* Input and Select - using secondary color for focus */
        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--secondary-color) !important;
            --tw-ring-color: var(--secondary-color) !important;
        }
        input.focus\:ring-gray-900:focus,
        select.focus\:ring-gray-900:focus,
        textarea.focus\:ring-gray-900:focus {
            --tw-ring-color: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
        }
        input.focus\:border-gray-900:focus,
        select.focus\:border-gray-900:focus,
        textarea.focus\:border-gray-900:focus {
            border-color: var(--secondary-color) !important;
        }
        
        /* Pagination - using secondary color */
        nav[role="navigation"] a,
        nav[role="navigation"] span,
        nav[role="navigation"] .relative a,
        nav[role="navigation"] .relative span,
        nav[role="navigation"] .flex a,
        nav[role="navigation"] .flex span,
        nav[role="navigation"] .inline-flex a,
        nav[role="navigation"] .inline-flex span {
            color: var(--secondary-color) !important;
        }
        nav[role="navigation"] a:hover {
            background-color: rgba(var(--secondary-rgb), 0.1) !important;
            border-color: var(--secondary-color) !important;
        }
        nav[role="navigation"] .relative.z-10,
        nav[role="navigation"] .z-10,
        nav[role="navigation"] .relative.z-10 span,
        nav[role="navigation"] .z-10 span {
            background-color: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
            color: white !important;
        }
        nav[role="navigation"] .relative.z-10 span,
        nav[role="navigation"] .z-10 span {
            color: white !important;
        }
        
        /* Badge and label supporting elements */
        .badge-secondary,
        .label-secondary {
            background-color: var(--secondary-color) !important;
            color: white !important;
        }
        
        /* Icon and accent colors */
        .icon-accent {
            color: var(--secondary-color) !important;
        }
        
        /* Progress bars and indicators */
        .progress-bar-secondary {
            background-color: var(--secondary-color) !important;
        }
        
        /* Links and interactive elements - using primary color */
        a.text-gray-900:hover,
        a.text-gray-700:hover {
            color: var(--primary-color) !important;
        }
        
        /* Active states - using primary color */
        .active,
        [aria-current="page"] {
            color: var(--primary-color) !important;
        }
        
        /* Apply primary color to common elements */
        button[type="submit"].bg-gray-900,
        a.bg-gray-900,
        .btn-primary {
            background-color: var(--primary-color) !important;
        }
        button[type="submit"].bg-gray-900:hover,
        a.bg-gray-900:hover,
        .btn-primary:hover {
            background-color: rgba(var(--primary-rgb), 0.9) !important;
        }
        
        /* Navbar active indicator */
        nav .absolute.bottom-0 {
            background-color: var(--primary-color) !important;
        }
        
        /* Avatar default background */
        .bg-gray-900.rounded-full {
            background-color: var(--primary-color) !important;
        }
        .minimal-swal-cancel {
            background-color: #f3f4f6 !important;
            color: #374151 !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            padding: 0.625rem 1.25rem !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: background-color 0.2s !important;
        }
        .minimal-swal-cancel:hover {
            background-color: #e5e7eb !important;
        }
        .minimal-swal-toast {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .minimal-swal-icon {
            border-color: #10b981 !important;
            color: #10b981 !important;
        }
        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
            color: #ef4444 !important;
        }
        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }
        .swal2-icon.swal2-question {
            border-color: #6b7280 !important;
            color: #6b7280 !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    @auth
        @include('partials.navbar')
    @endauth

    <main>
        @if(session('success'))
            <div id="success-message" data-message="{{ session('success') }}"></div>
        @endif

        @if(session('error'))
            <div id="error-message" data-message="{{ session('error') }}"></div>
        @endif

        @yield('content')
    </main>

    @auth
        @include('partials.footer')
    @endauth
</body>
</html>

