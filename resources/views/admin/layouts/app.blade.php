<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Elfafa Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .sidebar { transition: transform 0.3s ease; }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); position: fixed; z-index: 50; }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen lg:ml-64">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar fixed top-0 left-0 w-64 h-screen bg-gray-900 text-white overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">Elfafa Admin</h1>
                        <p class="text-xs text-gray-400">Service Management</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(session('admin_username', 'A'), 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium">{{ session('admin_username', 'Admin') }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-3 px-3">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.booking.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span>Booking</span>
                    @php $newBooking = \App\Models\Booking::where('status', 'Menunggu Konfirmasi')->count(); @endphp
                    @if($newBooking > 0)
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">{{ $newBooking }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.service.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.service.*') ? 'active' : '' }}">
                    <i class="fas fa-wrench w-5"></i>
                    <span>Service</span>
                </a>

                <a href="{{ route('admin.sparepart.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.sparepart.*') ? 'active' : '' }}">
                    <i class="fas fa-microchip w-5"></i>
                    <span>Sparepart</span>
                </a>

                <a href="{{ route('admin.testimoni.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
                    <i class="fas fa-star w-5"></i>
                    <span>Testimoni</span>
                </a>

                <a href="{{ route('admin.report.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.report.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Laporan</span>
                </a>

                <div class="border-t border-gray-800 my-4"></div>

                <a href="{{ route('beranda') }}" target="_blank" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition text-gray-400">
                    <i class="fas fa-external-link-alt w-5"></i>
                    <span>Lihat Website</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-600 transition text-red-400 hover:text-white">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-bold text-gray-800">@yield('header', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('l, d M Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mx-6 mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg" id="alert-success">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-6 mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" id="alert-error">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mx-6 mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.add('hidden');
        });

        // Auto hide alerts
        setTimeout(() => {
            document.getElementById('alert-success')?.remove();
            document.getElementById('alert-error')?.remove();
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>