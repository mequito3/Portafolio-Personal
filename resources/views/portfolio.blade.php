@extends('layouts.app')

@section('content')
    
    <!-- Hero Section -->
    <section id="hero" class="relative min-h-screen flex items-center justify-center px-4">
        <div class="relative z-10 text-center max-w-4xl mx-auto">

            <!-- Greeting -->
            <p class="text-neon-cyan font-medium mb-4 animate-on-scroll" style="animation-delay: 0.1s;">
                ¡Hola! Soy
            </p>
            
            <!-- Name -->
            <h1 class="font-display text-5xl sm:text-7xl md:text-8xl font-bold mb-6 animate-on-scroll" style="animation-delay: 0.2s;">
                <span class="gradient-text">{{ $profile['name'] }}</span>
            </h1>
            
            <!-- Title -->
            <h2 class="text-xl sm:text-2xl md:text-3xl text-gray-300 mb-8 animate-on-scroll" style="animation-delay: 0.3s;">
                <span class="text-white">{{ $profile['title'] }}</span>
            </h2>
            
            <!-- Description -->
            <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10 animate-on-scroll" style="animation-delay: 0.4s;">
                Creo experiencias digitales excepcionales con código limpio y diseño innovador.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 animate-on-scroll" style="animation-delay: 0.5s;">
                <a href="#projects" class="btn-glow px-8 py-4 bg-gradient-to-r from-neon-cyan to-neon-purple rounded-full font-semibold text-dark-900 hover:shadow-lg hover:shadow-neon-cyan/25 transition-all">
                    Ver Proyectos
                </a>
                <a href="#contact" class="px-8 py-4 glass rounded-full font-semibold hover:bg-white/10 transition-all">
                    Contactar
                </a>
            </div>
            
            <!-- Social Links -->
            <div class="flex items-center justify-center gap-6 animate-on-scroll" style="animation-delay: 0.6s;">
                <a href="{{ $profile['social']['github'] }}" target="_blank" class="p-3 glass rounded-full hover:bg-white/10 transition-all group">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                </a>
                <a href="{{ $profile['social']['linkedin'] }}" target="_blank" class="p-3 glass rounded-full hover:bg-white/10 transition-all group">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                    </svg>
                </a>
                <a href="{{ $profile['social']['twitter'] }}" target="_blank" class="p-3 glass rounded-full hover:bg-white/10 transition-all group">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>



    <!-- About Section -->
    <section id="about" class="relative py-20 lg:py-32 px-4 scroll-mt-16">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Avatar & Visual -->
                <div class="animate-on-scroll">
                    <div class="relative">
                        <!-- Glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-neon-cyan to-neon-magenta rounded-3xl blur-3xl opacity-20 animate-pulse-slow"></div>
                        
                        <!-- Avatar container -->
                        <div class="relative glass rounded-3xl p-8 animate-glow">
                            <div class="aspect-square rounded-2xl bg-gradient-to-br from-dark-700 to-dark-800 flex items-center justify-center overflow-hidden">
                                @if(!empty($profile['avatar']))
                                    <img src="{{ Str::startsWith($profile['avatar'], 'http') ? $profile['avatar'] : asset('storage/' . $profile['avatar']) }}" alt="{{ $profile['name'] }}" class="w-full h-full object-cover">
                                @else
                                <div class="text-center">
                                    <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-r from-neon-cyan to-neon-magenta flex items-center justify-center text-5xl font-display font-bold text-dark-900 mb-4">
                                        {{ substr($profile['name'], 0, 1) }}
                                    </div>
                                    <p class="text-gray-400 text-sm">Tu foto aquí</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="space-y-6">
                    <div class="animate-on-scroll">
                        <p class="text-neon-cyan font-medium mb-2">Conóceme</p>
                        <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">
                            Sobre <span class="gradient-text">Mí</span>
                        </h2>
                    </div>
                    
                    <p class="text-gray-300 text-lg leading-relaxed animate-on-scroll">
                        {{ $profile['bio'] }}
                    </p>
                    
                    <p class="text-gray-400 leading-relaxed animate-on-scroll">
                        Me encanta transformar ideas en código funcional y estéticamente atractivo. 
                        Mi enfoque combina creatividad con las mejores prácticas de desarrollo para 
                        entregar soluciones que no solo funcionan perfectamente, sino que también 
                        proporcionan una experiencia de usuario excepcional.
                    </p>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-6 animate-on-scroll">
                        <div class="text-center p-4 glass rounded-xl">
                            <div class="text-3xl font-display font-bold gradient-text">{{ $profile['stats']['years_experience'] }}+</div>
                            <div class="text-gray-400 text-sm mt-1">Años Exp.</div>
                        </div>
                        <div class="text-center p-4 glass rounded-xl">
                            <div class="text-3xl font-display font-bold gradient-text">{{ $profile['stats']['projects_count'] }}+</div>
                            <div class="text-gray-400 text-sm mt-1">Proyectos</div>
                        </div>
                        <div class="text-center p-4 glass rounded-xl">
                            <div class="text-3xl font-display font-bold gradient-text">{{ $profile['stats']['clients_count'] }}+</div>
                            <div class="text-gray-400 text-sm mt-1">Clientes</div>
                        </div>
                    </div>
                    
                    <div class="pt-4 animate-on-scroll">
                        <a href="#contact" class="inline-flex items-center gap-2 text-neon-cyan hover:text-white transition-colors">
                            ¿Tienes un proyecto?
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="relative py-20 lg:py-32 px-4 scroll-mt-16 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-neon-cyan/10 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-neon-magenta/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-display font-bold mb-4">
                    Servicios <span class="gradient-text">Profesionales</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-neon-cyan to-neon-magenta mx-auto rounded-full"></div>
                <p class="text-gray-400 mt-6 max-w-2xl mx-auto">
                    Soluciones tecnológicas integrales que combinan potencia técnica con diseño de vanguardia.
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1: Web Development -->
                <div class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 animate-on-scroll">
                    <div class="w-14 h-14 bg-neon-cyan/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-neon-cyan/30 group-hover:shadow-[0_0_20px_rgba(0,255,255,0.4)] transition-all">
                        <i class="fas fa-laptop-code text-2xl text-neon-cyan"></i>
                    </div>
                    <h3 class="text-xl font-display font-bold mb-4 group-hover:text-neon-cyan transition-colors">Desarrollo Web & CMS</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Creación de ecosistemas web robustos usando Laravel para lógica compleja y WordPress para una gestión de contenidos ágil y profesional.
                    </p>
                </div>

                <!-- Service 2: Mobile Development -->
                <div class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 animate-on-scroll" style="transition-delay: 100ms;">
                    <div class="w-14 h-14 bg-neon-purple/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-neon-purple/30 group-hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] transition-all">
                        <i class="fas fa-mobile-alt text-2xl text-neon-purple"></i>
                    </div>
                    <h3 class="text-xl font-display font-bold mb-4 group-hover:text-neon-purple transition-colors">Desarrollo Móvil</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Apps nativas y multiplataforma con interfaces fluidas, diseñadas para escalar y ofrecer una experiencia superior en cualquier dispositivo.
                    </p>
                </div>

                <!-- Service 3: n8n Automation -->
                <div class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 animate-on-scroll" style="transition-delay: 200ms;">
                    <div class="w-14 h-14 bg-neon-magenta/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-neon-magenta/30 group-hover:shadow-[0_0_20_rgba(255,0,255,0.4)] transition-all">
                        <i class="fas fa-project-diagram text-2xl text-neon-magenta"></i>
                    </div>
                    <h3 class="text-xl font-display font-bold mb-4 group-hover:text-neon-magenta transition-colors">Automatización n8n</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Diseño de flujos de trabajo inteligentes con n8n, conectando herramientas y automatizando tareas repetitivas para maximizar tu eficiencia.
                    </p>
                </div>

                <!-- Service 4: APIs & Cloud Architecture -->
                <div class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 animate-on-scroll" style="transition-delay: 300ms;">
                    <div class="w-14 h-14 bg-cyan-400/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-cyan-400/30 group-hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] transition-all">
                        <i class="fas fa-cloud-upload-alt text-2xl text-cyan-400"></i>
                    </div>
                    <h3 class="text-xl font-display font-bold mb-4 group-hover:text-cyan-400 transition-colors">APIs & Cloud</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Arquitectura de backend robusta y despliegue optimizado, garantizando que tus aplicaciones funcionen con la máxima velocidad y seguridad.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="relative py-20 lg:py-32 px-4 scroll-mt-16">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-10 animate-on-scroll">
                <p class="text-neon-magenta font-medium mb-2">Mi Trabajo</p>
                <h2 class="font-display text-4xl md:text-5xl font-bold">
                    Proyectos <span class="gradient-text">Destacados</span>
                </h2>
            </div>
            
            <!-- Project Filters -->
            @php 
                $allTags = $projects->pluck('tags')->flatten()->unique()->filter()->values(); 
            @endphp
            @if($allTags->count() > 0)
            <div class="flex flex-wrap justify-center gap-3 mb-12 animate-on-scroll" id="project-filters">
                <button data-filter="all" class="filter-btn active px-6 py-2 rounded-full border border-neon-magenta text-neon-magenta hover:bg-neon-magenta hover:text-dark-900 transition-all font-medium bg-neon-magenta/10">
                    Todos
                </button>
                @foreach($allTags as $tag)
                <button data-filter="{{ Str::slug($tag) }}" class="filter-btn px-6 py-2 rounded-full border border-dark-600 text-gray-400 hover:border-neon-cyan hover:text-neon-cyan transition-all font-medium bg-dark-800">
                    {{ $tag }}
                </button>
                @endforeach
            </div>
            @endif
            
            <style>
                .project-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
                .project-card.filter-hidden { 
                    opacity: 0; 
                    transform: scale(0.9); 
                    position: absolute; 
                    pointer-events: none;
                }
                .filter-btn.active {
                    background-color: rgba(255, 0, 255, 0.1);
                    border-color: #ff00ff;
                    color: #ff00ff;
                }
            </style>
            
            <!-- Projects Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid" style="position: relative;">
                @foreach($projects as $index => $project)
                @php $projectTags = collect((array)$project->tags)->map(fn($t) => Str::slug($t))->implode(' '); @endphp
                <div class="project-card card-3d glass rounded-2xl overflow-hidden group animate-on-scroll" data-tags="{{ $projectTags }}" style="animation-delay: {{ $index * 0.1 }}s;">
                    <!-- Image Area -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $project->image ? (Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image)) : 'https://via.placeholder.com/600x400/1a1a25/00ffff?text=Proyecto' }}" alt="{{ $project->title }}" class="project-image w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent"></div>
                        
                        <!-- Overlay clickable area for Details -->
                        <a href="{{ route('portfolio.projects.show', $project) }}" class="absolute inset-0 z-10"></a>

                        <!-- Overlay Buttons (Highest Z-index) -->
                        <div class="absolute bottom-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-20">
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="p-2 glass rounded-lg hover:bg-neon-magenta/20 hover:text-neon-magenta hover:border-neon-magenta/50 transition-all" title="Ver Código">
                                <i class="fab fa-github text-lg"></i>
                            </a>
                            @endif
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="p-2 glass rounded-lg hover:bg-neon-cyan/20 hover:text-neon-cyan hover:border-neon-cyan/50 transition-all" title="Ver Demo">
                                <i class="fas fa-external-link-alt text-sm"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <a href="{{ route('portfolio.projects.show', $project) }}" class="block mb-2 group/title">
                            <h3 class="font-display text-xl font-semibold group-hover:text-neon-cyan transition-colors italic">
                                {{ $project->title }}
                            </h3>
                        </a>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ $project->description }}
                        </p>
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2">
                            @foreach((array)$project->tags as $tag)
                            <span class="px-3 py-1 text-[10px] uppercase font-bold tracking-wider rounded-full bg-dark-700 text-gray-300 border border-dark-600">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="relative py-20 lg:py-32 px-4 scroll-mt-16">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 animate-on-scroll">
                <p class="text-neon-purple font-medium mb-2">Mis Habilidades</p>
                <h2 class="font-display text-4xl md:text-5xl font-bold">
                    Tecnologías y <span class="gradient-text">Tools</span>
                </h2>
            </div>
            
            <!-- Skills Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($skills as $category => $categorySkills)
                <div class="glass rounded-2xl p-6 animate-on-scroll" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-display text-xl font-semibold capitalize">{{ $category }}</h3>
                        <span class="text-neon-cyan font-bold">{{ $categorySkills->count() }}</span>
                    </div>
                    
                    <!-- Skill Pills with level -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($categorySkills as $skill)
                        <span class="skill-pill px-3 py-1.5 text-sm rounded-lg bg-dark-700 text-gray-300 border border-dark-600 cursor-default"
                              title="{{ $skill->level }}%">
                            @if($skill->icon)<i class="{{ $skill->icon }} mr-1"></i>@endif{{ $skill->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Code Snippet Decoration -->
            <div class="mt-16 animate-on-scroll">
                <div class="glass rounded-2xl p-6 font-mono text-sm overflow-x-auto">
                    <div class="text-gray-500">// Mi stack favorito</div>
                    <div class="mt-2">
                        <span class="text-neon-magenta">const</span> <span class="text-white">stack</span> = {
                    </div>
                    <div class="pl-4">
                        <span class="text-neon-cyan">backend</span>: <span class="text-green-400">'{{ $profile['stack']['backend'] }}'</span>,
                    </div>
                    <div class="pl-4">
                        <span class="text-neon-cyan">frontend</span>: <span class="text-green-400">'{{ $profile['stack']['frontend'] }}'</span>,
                    </div>
                    <div class="pl-4">
                        <span class="text-neon-cyan">database</span>: <span class="text-green-400">'{{ $profile['stack']['database'] }}'</span>,
                    </div>
                    <div class="pl-4">
                        <span class="text-neon-cyan">devops</span>: <span class="text-green-400">'{{ $profile['stack']['devops'] }}'</span>
                    </div>
                    <div>};</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="relative py-20 lg:py-32 px-4 scroll-mt-16">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 animate-on-scroll">
                <p class="text-neon-cyan font-medium mb-2">Contáctame</p>
                <h2 class="font-display text-4xl md:text-5xl font-bold">
                    Trabajemos <span class="gradient-text">Juntos</span>
                </h2>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8 animate-on-scroll">
                    <p class="text-gray-300 text-lg">
                        ¿Tienes un proyecto en mente? Me encantaría escuchar sobre él. 
                        Envíame un mensaje y te responderé lo antes posible.
                    </p>
                    
                    <!-- Contact Cards -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 glass rounded-xl hover:bg-white/10 transition-colors cursor-pointer">
                            <div class="p-3 bg-gradient-to-r from-neon-cyan to-neon-purple rounded-lg">
                                <svg class="w-6 h-6 text-dark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Email</p>
                                <p class="text-white font-medium">{{ $profile['email'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 glass rounded-xl hover:bg-white/10 transition-colors cursor-pointer">
                            <div class="p-3 bg-gradient-to-r from-neon-magenta to-neon-purple rounded-lg">
                                <svg class="w-6 h-6 text-dark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Teléfono</p>
                                <p class="text-white font-medium">{{ $profile['phone'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 glass rounded-xl hover:bg-white/10 transition-colors cursor-pointer">
                            <div class="p-3 bg-gradient-to-r from-neon-purple to-neon-cyan rounded-lg">
                                <svg class="w-6 h-6 text-dark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Ubicación</p>
                                <p class="text-white font-medium">{{ $profile['location'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="flex flex-wrap items-center gap-6 pt-4">
                        <div class="flex gap-4">
                            <a href="{{ $profile['social']['github'] }}" target="_blank" class="p-3 glass rounded-xl hover:bg-white/10 transition-all hover:scale-110">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                            <a href="{{ $profile['social']['linkedin'] }}" target="_blank" class="p-3 glass rounded-xl hover:bg-white/10 transition-all hover:scale-110">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="{{ $profile['social']['twitter'] }}" target="_blank" class="p-3 glass rounded-xl hover:bg-white/10 transition-all hover:scale-110">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Footer Logo --}}
                        <div class="relative flex items-center justify-center p-2">
                            <div class="absolute inset-0 bg-neon-cyan/20 blur-[15px] rounded-full scale-110 mix-blend-lighten pointer-events-none"></div>
                            @if(isset($profile['logo']) && $profile['logo'])
                                <img src="{{ Str::startsWith($profile['logo'], 'http') ? $profile['logo'] : asset('storage/' . $profile['logo']) }}" 
                                     class="relative z-10 h-10 w-auto object-contain opacity-80 hover:opacity-100 transition-all duration-300 hover:scale-110">
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="animate-on-scroll">
                    {{-- Toast Container for AJAX Notifications --}}
                    <div id="toast-container" class="fixed bottom-5 right-5 z-[200] flex flex-col gap-3"></div>

                    <style>
                        @keyframes slideInRight {
                            from { opacity: 0; transform: translateX(100%); }
                            to { opacity: 1; transform: translateX(0); }
                        }
                        .toast-enter {
                            animation: slideInRight 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                        }
                    </style>

                    <form id="contactForm" action="{{ route('portfolio.contact') }}" method="POST" class="glass rounded-2xl p-8 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nombre</label>
                            <input type="text" id="name" name="name" placeholder="Tu nombre" required
                                   class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-neon-cyan transition-colors">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" placeholder="tu@email.com" required
                                   class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-neon-cyan transition-colors">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">Asunto</label>
                            <input type="text" id="subject" name="subject" placeholder="Asunto del mensaje" 
                                   class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-neon-cyan transition-colors">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Mensaje</label>
                            <textarea id="message" name="message" rows="5" placeholder="Cuéntame sobre tu proyecto..." required
                                      class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-neon-cyan transition-colors resize-none"></textarea>
                        </div>
                        
                        <button type="submit" id="submitBtn" class="btn-glow w-full py-4 bg-gradient-to-r from-neon-cyan to-neon-purple rounded-xl font-semibold text-dark-900 hover:shadow-lg hover:shadow-neon-cyan/25 transition-all flex items-center justify-center gap-2">
                            <span id="submitBtnText">Enviar Mensaje</span>
                            <i id="submitBtnSpinner" class="fas fa-circle-notch fa-spin hidden"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative py-8 px-4 border-t border-dark-700 mt-20">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-gray-400">
                &copy; {{ date('Y') }} <span class="text-white font-medium">{{ $profile['name'] }}</span>. Todos los derechos reservados.
            </p>
            <p class="text-gray-600 text-sm mt-2 flex items-center justify-center gap-1">
                Hecho con <span class="text-neon-magenta animate-pulse text-lg">❤</span> usando Laravel 
            </p>
        </div>
    </footer>

@endsection

@section('scripts')
    <!-- 3D Scene Container moved to layout, but we can keep it here if layout doesn't have it -->
    <!-- Actually layout has it, so we can remove it here if redundant -->

    <!-- Contact Form AJAX Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const contactForm = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnSpinner = document.getElementById('submitBtnSpinner');
            const toastContainer = document.getElementById('toast-container');

            function showToast(type, title, message) {
                const toast = document.createElement('div');
                toast.className = `toast-enter glass backdrop-blur-md p-5 rounded-xl shadow-lg flex items-start gap-4 border pointer-events-auto max-w-sm`;
                
                let iconClass = '';
                if(type === 'success') {
                    toast.classList.add('border-green-500/50', 'bg-green-900/40', 'text-green-400');
                    iconClass = 'fas fa-check-circle text-green-400 mt-0.5 text-xl';
                } else {
                    toast.classList.add('border-red-500/50', 'bg-red-900/40', 'text-red-400');
                    iconClass = 'fas fa-exclamation-circle text-red-400 mt-0.5 text-xl';
                }

                toast.innerHTML = `
                    <i class="${iconClass}"></i>
                    <div class="flex-1">
                        <h4 class="font-bold text-white text-sm">${title}</h4>
                        <p class="text-xs font-medium text-gray-300 mt-1">${message}</p>
                    </div>
                    <button class="text-gray-400 hover:text-white transition-colors" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                toastContainer.appendChild(toast);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.transition = 'all 0.4s ease';
                    setTimeout(() => toast.remove(), 400);
                }, 5000);
            }

            if(contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Set Loading State
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    submitBtnText.innerText = 'Enviando...';
                    submitBtnSpinner.classList.remove('hidden');

                    const formData = new FormData(contactForm);
                    
                    fetch(contactForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        return response.json().then(data => ({status: response.status, body: data}));
                    })
                    .then(({status, body}) => {
                        // Reset Loading State
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        submitBtnText.innerText = 'Enviar Mensaje';
                        submitBtnSpinner.classList.add('hidden');

                        if(status === 200 || status === 201) {
                            showToast('success', '¡Mensaje Enviado!', body.message || 'Me pondré en contacto contigo pronto.');
                            contactForm.reset();
                        } else if (status === 422) {
                            let errorsHTML = Object.values(body.errors || {}).map(e => `• ${e[0]}`).join('<br>');
                            showToast('error', 'Revisa los campos', errorsHTML || 'Tus datos son incorrectos.');
                        } else {
                            showToast('error', 'Ocurrió un error', body.message || 'Intenta de nuevo más tarde.');
                        }
                    })
                    .catch(error => {
                        // Reset Loading State
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        submitBtnText.innerText = 'Enviar Mensaje';
                        submitBtnSpinner.classList.add('hidden');
                        
                        showToast('error', 'Error de Conexión', 'No se pudo contactar al servidor.');
                    });
                });
            }
        });
    </script>

    <!-- Project Filtering Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');
            
            if(!filterBtns.length) return;

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update active state
                    filterBtns.forEach(b => {
                        b.classList.remove('active', 'border-neon-magenta', 'text-neon-magenta', 'bg-neon-magenta/10');
                        b.classList.add('border-dark-600', 'text-gray-400', 'bg-dark-800');
                    });
                    
                    btn.classList.add('active', 'border-neon-magenta', 'text-neon-magenta', 'bg-neon-magenta/10');
                    btn.classList.remove('border-dark-600', 'text-gray-400', 'bg-dark-800');
                    
                    const filterValue = btn.getAttribute('data-filter');
                    
                    projectCards.forEach(card => {
                        if(filterValue === 'all') {
                            card.classList.remove('filter-hidden');
                            card.style.position = 'relative';
                        } else {
                            const tags = card.getAttribute('data-tags') || '';
                            if(tags.includes(filterValue)) {
                                card.classList.remove('filter-hidden');
                                setTimeout(() => { card.style.position = 'relative'; }, 50);
                            } else {
                                card.classList.add('filter-hidden');
                                setTimeout(() => { card.style.position = 'absolute'; }, 400);
                            }
                        }
                    });
                });
            });
        });
    </script>
    
    <!-- Three.js 3D Scene -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // ============================================
        // Three.js 3D Scene - Geometries & Particles
        // ============================================
        
        (function() {
            // Scene setup
            const canvas = document.getElementById('scene-container');
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({ 
                canvas: canvas, 
                alpha: true, 
                antialias: true 
            });
            
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            
            camera.position.z = 30;
            
            // Mouse tracking
            let mouseX = 0;
            let mouseY = 0;
            let targetX = 0;
            let targetY = 0;
            
            document.addEventListener('mousemove', (e) => {
                mouseX = (e.clientX / window.innerWidth) * 2 - 1;
                mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
            });
            
            // Colors
            const colors = {
                cyan: 0x00ffff,
                magenta: 0xff00ff,
                purple: 0xa855f7,
                white: 0xffffff
            };
            
            // Create geometries
            const geometries = [];
            
            // Torus
            const torusGeometry = new THREE.TorusGeometry(3, 0.5, 16, 100);
            const torusMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.cyan, 
                wireframe: true,
                transparent: true,
                opacity: 0.6
            });
            const torus = new THREE.Mesh(torusGeometry, torusMaterial);
            torus.position.set(-15, 5, -10);
            scene.add(torus);
            geometries.push({ mesh: torus, rotationSpeed: { x: 0.01, y: 0.015, z: 0 } });
            
            // Torus 2
            const torus2Geometry = new THREE.TorusGeometry(2, 0.3, 16, 100);
            const torus2Material = new THREE.MeshBasicMaterial({ 
                color: colors.magenta, 
                wireframe: true,
                transparent: true,
                opacity: 0.5
            });
            const torus2 = new THREE.Mesh(torus2Geometry, torus2Material);
            torus2.position.set(15, -8, -8);
            scene.add(torus2);
            geometries.push({ mesh: torus2, rotationSpeed: { x: 0.008, y: 0.012, z: 0.005 } });
            
            // Icosahedron
            const icoGeometry = new THREE.IcosahedronGeometry(2.5, 0);
            const icoMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.purple, 
                wireframe: true,
                transparent: true,
                opacity: 0.5
            });
            const icosahedron = new THREE.Mesh(icoGeometry, icoMaterial);
            icosahedron.position.set(12, 10, -15);
            scene.add(icosahedron);
            geometries.push({ mesh: icosahedron, rotationSpeed: { x: 0.015, y: 0.01, z: 0.008 } });
            
            // Octahedron
            const octGeometry = new THREE.OctahedronGeometry(2, 0);
            const octMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.cyan, 
                wireframe: true,
                transparent: true,
                opacity: 0.4
            });
            const octahedron = new THREE.Mesh(octGeometry, octMaterial);
            octahedron.position.set(-12, -10, -12);
            scene.add(octahedron);
            geometries.push({ mesh: octahedron, rotationSpeed: { x: 0.012, y: 0.018, z: 0.006 } });
            
            // Box
            const boxGeometry = new THREE.BoxGeometry(2, 2, 2);
            const boxMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.magenta, 
                wireframe: true,
                transparent: true,
                opacity: 0.4
            });
            const box = new THREE.Mesh(boxGeometry, boxMaterial);
            box.position.set(18, 0, -20);
            scene.add(box);
            geometries.push({ mesh: box, rotationSpeed: { x: 0.01, y: 0.01, z: 0.015 } });
            
            // Dodecahedron
            const dodGeometry = new THREE.DodecahedronGeometry(1.5, 0);
            const dodMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.purple, 
                wireframe: true,
                transparent: true,
                opacity: 0.5
            });
            const dodecahedron = new THREE.Mesh(dodGeometry, dodMaterial);
            dodecahedron.position.set(-18, 8, -18);
            scene.add(dodecahedron);
            geometries.push({ mesh: dodecahedron, rotationSpeed: { x: 0.02, y: 0.015, z: 0.01 } });
            
            // Sphere wireframe
            const sphereGeometry = new THREE.SphereGeometry(1.5, 16, 16);
            const sphereMaterial = new THREE.MeshBasicMaterial({ 
                color: colors.cyan, 
                wireframe: true,
                transparent: true,
                opacity: 0.3
            });
            const sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
            sphere.position.set(0, -12, -10);
            scene.add(sphere);
            geometries.push({ mesh: sphere, rotationSpeed: { x: 0.005, y: 0.008, z: 0.003 } });
            
            // Particles
            const particlesGeometry = new THREE.BufferGeometry();
            const particleCount = 500;
            const posArray = new Float32Array(particleCount * 3);
            const colorArray = new Float32Array(particleCount * 3);
            
            const colorOptions = [
                new THREE.Color(colors.cyan),
                new THREE.Color(colors.magenta),
                new THREE.Color(colors.purple),
                new THREE.Color(colors.white)
            ];
            
            for (let i = 0; i < particleCount * 3; i += 3) {
                posArray[i] = (Math.random() - 0.5) * 100;
                posArray[i + 1] = (Math.random() - 0.5) * 100;
                posArray[i + 2] = (Math.random() - 0.5) * 100;
                
                const color = colorOptions[Math.floor(Math.random() * colorOptions.length)];
                colorArray[i] = color.r;
                colorArray[i + 1] = color.g;
                colorArray[i + 2] = color.b;
            }
            
            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
            particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colorArray, 3));
            
            const particlesMaterial = new THREE.PointsMaterial({
                size: 0.15,
                vertexColors: true,
                transparent: true,
                opacity: 0.8
            });
            
            const particles = new THREE.Points(particlesGeometry, particlesMaterial);
            scene.add(particles);
            
            // Stars background
            const starsGeometry = new THREE.BufferGeometry();
            const starsCount = 1000;
            const starsPosArray = new Float32Array(starsCount * 3);
            
            for (let i = 0; i < starsCount * 3; i += 3) {
                starsPosArray[i] = (Math.random() - 0.5) * 200;
                starsPosArray[i + 1] = (Math.random() - 0.5) * 200;
                starsPosArray[i + 2] = (Math.random() - 0.5) * 200 - 50;
            }
            
            starsGeometry.setAttribute('position', new THREE.BufferAttribute(starsPosArray, 3));
            
            const starsMaterial = new THREE.PointsMaterial({
                size: 0.05,
                color: 0xffffff,
                transparent: true,
                opacity: 0.6
            });
            
            const stars = new THREE.Points(starsGeometry, starsMaterial);
            scene.add(stars);
            
            // Animation loop
            function animate() {
                requestAnimationFrame(animate);
                
                // Smooth camera movement
                targetX += (mouseX * 3 - targetX) * 0.02;
                targetY += (mouseY * 3 - targetY) * 0.02;
                camera.position.x = targetX;
                camera.position.y = targetY;
                camera.lookAt(scene.position);
                
                // Rotate geometries
                geometries.forEach(item => {
                    item.mesh.rotation.x += item.rotationSpeed.x;
                    item.mesh.rotation.y += item.rotationSpeed.y;
                    item.mesh.rotation.z += item.rotationSpeed.z;
                });
                
                // Rotate particles slowly
                particles.rotation.y += 0.0003;
                particles.rotation.x += 0.0001;
                
                // Rotate stars
                stars.rotation.y += 0.0001;
                
                renderer.render(scene, camera);
            }
            
            animate();
            
            // Handle resize
            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        })();

        // ============================================
        // Scroll Animations, Menu, etc.
        // ============================================
    </script>
@endsection
