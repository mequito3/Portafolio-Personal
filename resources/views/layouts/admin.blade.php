<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard')</title>

    @if(auth()->check() && auth()->user()->favicon)
        <link rel="icon" type="image/png"
            href="{{ Str::startsWith(auth()->user()->favicon, 'http') ? auth()->user()->favicon : asset('storage/' . auth()->user()->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        dark: {
                            900: '#030712',
                            800: '#0f172a',
                            700: '#1e293b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            background-color: #030712;
            background-image:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
        }

        .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(99, 102, 241, 0.4);
            background: rgba(30, 41, 59, 0.6);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 12px;
            color: #94a3b8;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            font-size: 0.925rem;
            font-weight: 500;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f8fafc;
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    @stack('styles')
</head>

<body class="text-gray-100 min-h-screen flex font-sans">

    {{-- Sidebar --}}
    <aside class="w-72 glass border-r border-white/5 flex flex-col min-h-screen fixed top-0 left-0 z-30">
        {{-- Logo --}}
        <div class="px-8 py-8 flex justify-center">
            <a href="{{ route('admin.dashboard') }}" class="relative block w-full max-w-[200px] group py-4">
                <!-- Difuminado (Glow Background) -->
                <div
                    class="absolute inset-0 bg-white/20 blur-[30px] rounded-full scale-150 group-hover:bg-white/30 transition-all duration-500">
                </div>

                @if(auth()->check() && auth()->user()->logo)
                    <img src="{{ Str::startsWith(auth()->user()->logo, 'http') ? auth()->user()->logo : asset('storage/' . auth()->user()->logo) }}"
                        alt="Americo Labs Logo"
                        class="relative z-10 max-h-16 w-auto object-contain opacity-100 group-hover:scale-110 transition-transform duration-300 drop-shadow-[0_2px_15px_rgba(255,255,255,0.3)]">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Americo Labs Logo"
                        class="relative z-10 max-h-16 w-auto object-contain opacity-90 group-hover:opacity-100 group-hover:scale-110 transition-transform duration-300 drop-shadow-[0_2px_15px_rgba(255,255,255,0.3)]">
                @endif
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-2 space-y-1.5 overflow-y-auto custom-scrollbar">
            <div class="px-4 mb-2 text-[11px] font-bold text-gray-500 uppercase tracking-[2px]">Overview</div>

            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-grid-2 text-center w-5"></i>
                Dashboard
            </a>

            <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-gray-500 uppercase tracking-[2px]">Content</div>

            <a href="{{ route('admin.projects.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="fas fa-rocket text-center w-5"></i>
                Proyectos
            </a>

            <a href="{{ route('admin.skills.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <i class="fas fa-microchip text-center w-5"></i>
                Habilidades
            </a>

            <a href="{{ route('admin.experiences.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase text-center w-5"></i>
                Experiencia
            </a>

            <a href="{{ route('admin.contacts.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-paper-plane text-center w-5"></i>
                Mensajes
                @php $unread = \App\Models\Contact::unread()->count(); @endphp
                @if($unread > 0)
                    <span
                        class="ml-auto bg-indigo-500 text-white text-[10px] font-bold rounded-full px-2 py-0.5 shadow-lg shadow-indigo-500/40">{{ $unread }}</span>
                @endif
            </a>

            <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-gray-500 uppercase tracking-[2px]">System</div>

            <a href="{{ route('admin.profile.edit') }}"
                class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fas fa-user-gear text-center w-5"></i>
                Configuración
            </a>

            <a href="{{ route('portfolio.index') }}" target="_blank" class="sidebar-link group">
                <i class="fas fa-external-link-alt text-center w-5 group-hover:text-indigo-400"></i>
                Vista Pública
            </a>
        </nav>

        {{-- Logout --}}
        <div class="p-4 mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                    class="sidebar-link w-full text-red-400/80 hover:bg-red-500/10 hover:text-red-400 border border-transparent hover:border-red-500/20">
                    <i class="fas fa-power-off text-center w-5"></i>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="ml-72 flex-1 flex flex-col min-h-screen relative">
        {{-- Header --}}
        <header class="h-20 flex items-center justify-between px-10 sticky top-0 z-20 glass border-b border-white/5">
            <h2 class="font-display font-semibold text-xl text-white">@yield('title', 'Dashboard')</h2>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 pl-6 border-l border-white/10">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-white leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider">Administrador</p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 p-[2px] shadow-lg shadow-indigo-500/20">
                        @if(auth()->user()->avatar)
                            <img src="{{ \Illuminate\Support\Str::startsWith(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}"
                                alt="Avatar" class="w-full h-full rounded-full object-cover">
                        @else
                            <div
                                class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center text-indigo-400">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <div class="p-10 flex-1">
            {{-- Alerts --}}
            @if(session('success'))
                <div
                    class="mb-8 glass-card border-green-500/20 bg-green-500/5 p-4 rounded-2xl flex items-center gap-3 text-green-400 animate-slide-in">
                    <i class="fas fa-circle-check text-lg"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-8 glass-card border-red-500/20 bg-red-500/5 p-4 rounded-2xl flex items-center gap-3 text-red-400 animate-slide-in">
                    <i class="fas fa-circle-exclamation text-lg"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </div>

        <footer class="px-10 py-6 text-gray-600 text-[11px] uppercase tracking-[2px] font-medium opacity-50">
            &copy; {{ date('Y') }} — Premium Portfolio Engine v1.0
        </footer>
    </main>

    @stack('scripts')
</body>

</html>