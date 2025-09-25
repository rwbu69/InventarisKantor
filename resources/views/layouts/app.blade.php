<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Inventaris Kantor')</title>
    <!-- Heroicons -->
    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js" type="module"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/24/solid/index.js" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <nav class="w-64 bg-gradient-to-br from-indigo-600 to-purple-700 shadow-xl">
            <div class="p-6">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 text-white mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6a2 2 0 012-2h8a2 2 0 012 2v2h2a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                        </svg>
                        <h4 class="text-white text-xl font-bold">Inventaris</h4>
                    </div>
                    <p class="text-indigo-200 text-sm">Sistem Manajemen Kantor</p>
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('inventories.index') }}" 
                       class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-violet-600 hover:bg-opacity-20 {{ request()->routeIs('inventories.index') ? 'bg-violet-600 bg-opacity-25 font-semibold' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('inventories.create') }}" 
                       class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-violet-600 hover:bg-opacity-20 {{ request()->routeIs('inventories.create') ? 'bg-violet-600 bg-opacity-25 font-semibold' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd"/>
                        </svg>
                        Tambah Barang
                    </a>
                </nav>
            </div>
        </nav>

        <!-- Main content -->
        <main class="flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            {{ now()->translatedFormat('l, d F Y') }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alert Messages -->
            <div class="px-6 py-4">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-800 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-red-800 font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="px-6 pb-6">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>