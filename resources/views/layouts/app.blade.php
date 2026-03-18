<!DOCTYPE html>
<html lang="es" class="scroll-smooth overflow-x-hidden">
<head>
    <style>html, body { background-color: #0a0a0f !important; color: white; }</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portafolio profesional de {{ $profile['name'] ?? 'Tu Nombre' }} - {{ $profile['title'] ?? 'Desarrollador' }}">
    <title>@yield('title', ($profile['name'] ?? 'Tu Nombre') . ' | ' . ($profile['title'] ?? 'Portafolio'))</title>
    
    @if(isset($profile['favicon']) && $profile['favicon'])
        <link rel="icon" type="image/png" href="{{ Str::startsWith($profile['favicon'], 'http') ? $profile['favicon'] : asset('storage/' . $profile['favicon']) }}">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'display': ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        'neon-cyan': '#00ffff',
                        'neon-magenta': '#ff00ff',
                        'neon-purple': '#a855f7',
                        'dark': {
                            900: '#0a0a0f',
                            800: '#12121a',
                            700: '#1a1a25',
                            600: '#252530',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'gradient': 'gradient 8s ease infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-in': 'fadeInUp 0.6s ease-out forwards',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(0, 255, 255, 0.3), 0 0 40px rgba(0, 255, 255, 0.1); }
            to { box-shadow: 0 0 30px rgba(255, 0, 255, 0.4), 0 0 60px rgba(255, 0, 255, 0.2); }
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #00ffff, #ff00ff, #a855f7, #00ffff);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 8s ease infinite;
        }
        
        /* Canvas 3D */
        #scene-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Card 3D effect */
        .card-3d {
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg) translateZ(20px);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00ffff, #ff00ff);
            border-radius: 4px;
        }
        
        /* Navigation */
        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00ffff, #ff00ff);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Mobile Menu Sidebar Redesign */
        #mobile-menu {
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            background-color: #0a0a0f !important;
            z-index: 100000 !important;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
        }
        
        #mobile-menu-overlay {
            transition: opacity 0.4s ease;
            z-index: 99999 !important;
        }

        .mobile-nav-link-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            width: 100%;
        }

        @yield('styles')
    </style>
</head>
<body class="bg-dark-900 text-white font-sans antialiased overflow-x-hidden w-full max-w-full selection:bg-neon-magenta/30 selection:text-white">
    
    <!-- Reading Progress Bar -->
    <div class="fixed top-0 left-0 h-1 bg-gradient-to-r from-neon-cyan via-neon-purple to-neon-magenta z-[100] transition-all duration-150 ease-out" id="reading-progress" style="width: 0%"></div>

    <!-- 3D Scene Container -->
    <canvas id="scene-container"></canvas>
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between min-h-[4rem] py-2">
                <a href="{{ route('portfolio.index') }}#hero" class="relative flex items-center justify-center group py-2 ml-2">
                    <div class="absolute inset-0 bg-white/20 md:bg-white/40 blur-[15px] md:blur-[24px] rounded-[100%] scale-[1.2] md:scale-[2.0] mix-blend-lighten pointer-events-none"></div>
                    @if(isset($profile['logo']) && $profile['logo'])
                        <img src="{{ Str::startsWith($profile['logo'], 'http') ? $profile['logo'] : asset('storage/' . $profile['logo']) }}" class="relative z-10 h-9 md:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
                    @endif
                </a>
                
                
                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center mr-2">
                    <button id="mobile-menu-btn" class="p-2 text-gray-300 hover:text-white transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('portfolio.index') }}#hero" class="nav-link text-gray-300 hover:text-white transition-colors">Inicio</a>
                    <a href="{{ route('portfolio.index') }}#about" class="nav-link text-gray-300 hover:text-white transition-colors">Sobre Mí</a>
                    <a href="{{ route('portfolio.index') }}#services" class="nav-link text-gray-300 hover:text-white transition-colors">Servicios</a>
                    <a href="{{ route('portfolio.index') }}#projects" class="nav-link text-gray-300 hover:text-white transition-colors">Proyectos</a>
                    <a href="{{ route('portfolio.index') }}#skills" class="nav-link text-gray-300 hover:text-white transition-colors">Skills</a>
                    <a href="{{ route('portfolio.index') }}#contact" class="nav-link text-gray-300 hover:text-white transition-colors">Contacto</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Mobile Menu Overlay Background -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden opacity-0"></div>

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu" class="fixed top-0 right-0 bottom-0 w-[85%] max-w-[320px] translate-x-full flex flex-col p-8 hidden">
        <div class="flex items-center justify-between mb-12">
            <span class="text-neon-cyan font-display font-bold tracking-widest uppercase text-sm">Menú</span>
            <button id="mobile-menu-close" class="p-2 text-gray-400 hover:text-white transition-all hover:rotate-90">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="flex flex-col space-y-2 w-full">
            <a href="{{ route('portfolio.index') }}#hero" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-neon-cyan/50 mr-4">01.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-neon-cyan transition-colors">Inicio</span>
            </a>
            <a href="{{ route('portfolio.index') }}#about" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-neon-purple/50 mr-4">02.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-neon-purple transition-colors">Sobre Mí</span>
            </a>
            <a href="{{ route('portfolio.index') }}#services" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-neon-cyan/50 mr-4">03.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-neon-cyan transition-colors">Servicios</span>
            </a>
            <a href="{{ route('portfolio.index') }}#projects" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-neon-magenta/50 mr-4">04.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-neon-magenta transition-colors">Proyectos</span>
            </a>
            <a href="{{ route('portfolio.index') }}#skills" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-cyan-400/50 mr-4">05.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-cyan-400 transition-colors">Skills</span>
            </a>
            <a href="{{ route('portfolio.index') }}#contact" class="mobile-nav-link mobile-nav-link-item py-4 flex items-center group">
                <span class="text-xs font-bold text-neon-cyan/50 mr-4">06.</span>
                <span class="text-xl font-display font-medium text-white group-hover:text-neon-cyan transition-colors">Contacto</span>
            </a>
        </div>
        
        <div class="mt-auto pt-10 flex flex-col space-y-6">
            <p class="text-gray-500 text-xs uppercase tracking-widest font-bold">Redes</p>
            <div class="flex gap-4">
                @if(isset($profile['social']['github']))
                <a href="{{ $profile['social']['github'] }}" target="_blank" class="p-3 glass rounded-xl text-gray-400 hover:text-white transition-all">
                    <i class="fab fa-github text-xl"></i>
                </a>
                @endif
                @if(isset($profile['social']['linkedin']))
                <a href="{{ $profile['social']['linkedin'] }}" target="_blank" class="p-3 glass rounded-xl text-gray-400 hover:text-white transition-all">
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
                @endif
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Back to Top -->
    <a href="#hero" id="backToTop" class="fixed bottom-5 left-5 z-[100] p-4 glass rounded-full opacity-0 translate-y-10 pointer-events-none transition-all duration-300 hover:bg-white/10 group hover:-translate-y-1 shadow-[0_0_15px_rgba(0,255,255,0.2)]">
        <svg class="w-6 h-6 text-neon-cyan group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </a>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile['phone'] ?? '1234567890') }}?text=Hola,%20vi%20tu%20portafolio%20y%20me%20gustar%C3%ADa%20contactarte." 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-5 right-5 z-[100] p-4 bg-green-500 rounded-full transition-all duration-300 hover:bg-green-400 hover:-translate-y-1 hover:scale-105 shadow-[0_0_20px_rgba(34,197,94,0.4)] group flex items-center justify-center">
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
    </a>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Copy the scene initialization script from portfolio.blade.php if needed, 
        // but for now let's keep it simple or yield it.
    </script>
    @yield('scripts')
    
    <script>
        // Intersection Observer for animations
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

        // Reading Progress
        const readingProgress = document.getElementById('reading-progress');
        window.addEventListener('scroll', () => {
            const documentHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercentage = (window.scrollY / documentHeight) * 100;
            if(readingProgress) readingProgress.style.width = scrollPercentage + '%';
        });

        // Mobile Menu Logic (Sidebar)
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-menu-overlay');
        const mobileLinks = document.querySelectorAll('.mobile-nav-link');

        if(mobileMenuBtn && mobileMenu && mobileOverlay) {
            const openMenu = () => {
                mobileMenu.classList.remove('hidden');
                mobileOverlay.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenu.classList.remove('translate-x-full');
                    mobileOverlay.classList.remove('opacity-0');
                    mobileOverlay.classList.add('opacity-100');
                }, 10);
                document.body.style.overflow = 'hidden';
            };

            const closeMenu = () => {
                mobileMenu.classList.add('translate-x-full');
                mobileOverlay.classList.remove('opacity-100');
                mobileOverlay.classList.add('opacity-0');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileOverlay.classList.add('hidden');
                }, 400);
                document.body.style.overflow = 'auto';
            };

            mobileMenuBtn.addEventListener('click', openMenu);
            mobileMenuClose.addEventListener('click', closeMenu);
            mobileOverlay.addEventListener('click', closeMenu);
            mobileLinks.forEach(link => link.addEventListener('click', closeMenu));
        }

        // Nav Highlighting Logic
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active', 'text-white');
                link.classList.add('text-gray-300');
                if (current && link.getAttribute('href').includes(`#${current}`)) {
                    link.classList.add('active', 'text-white');
                    link.classList.remove('text-gray-300');
                }
            });

            // Back to Top visibility
            if(backToTop) {
                if(window.scrollY > 500) {
                    backToTop.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
                    backToTop.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                } else {
                    backToTop.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
                    backToTop.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                }
            }
        });
    </script>
</body>
</html>
