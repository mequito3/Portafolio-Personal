@extends('layouts.admin')

@section('title', 'Mi Perfil')

@section('content')

<div class="max-w-2xl space-y-6">

    {{-- Profile Info --}}
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <h2 class="text-lg font-semibold text-white mb-5">Información Personal</h2>
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            @if($errors->any())
            <div class="bg-red-900/50 border border-red-600 text-red-300 px-4 py-3 rounded-lg">
                <p class="font-medium flex items-center gap-2 mb-1"><i class="fas fa-exclamation-triangle"></i> Corrige los errores:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full bg-gray-700 border @error('name') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full bg-gray-700 border @error('email') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Cargo / Título</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $user->job_title) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Desarrollador Full Stack">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Ubicación</label>
                    <input type="text" name="location" value="{{ old('location', $user->location) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Ciudad, País">
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Años de Experiencia</label>
                    <input type="number" min="0" name="years_experience" value="{{ old('years_experience', $user->years_experience) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Ej: 5">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Total de Clientes</label>
                    <input type="number" min="0" name="clients_count" value="{{ old('clients_count', $user->clients_count) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Ej: 30">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Teléfono</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Foto de Perfil</label>
                    <div x-data="{ 
                            photoName: null, 
                            photoPreview: null,
                            getFileUrl(file) {
                                return URL.createObjectURL(file);
                            }
                         }" 
                         class="col-span-6 sm:col-span-4 flex items-center gap-4">
                        
                        <!-- Hidden File Input -->
                        <input type="file" name="avatar" class="hidden" x-ref="photo"
                               accept="image/*"
                               @change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                    reader.readAsDataURL($refs.photo.files[0]);
                               ">
                               
                        <!-- Current Profile Photo -->
                        <div class="relative w-14 h-14 rounded-full overflow-hidden border-2 border-indigo-500/30 flex-shrink-0" x-show="!photoPreview">
                            @if($user->avatar)
                                <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                    <i class="fas fa-user text-xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- New Profile Photo Preview -->
                        <div class="relative w-14 h-14 rounded-full overflow-hidden border-2 border-emerald-500 flex-shrink-0" x-show="photoPreview" style="display: none;">
                            <span class="block w-full h-full bg-cover bg-no-repeat bg-center" :style="'background-image: url(\'' + photoPreview + '\');'"></span>
                        </div>
                        
                        <!-- Upload Button -->
                        <div class="flex-1">
                            <button type="button" @click.prevent="$refs.photo.click()" class="bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 font-medium px-4 py-2 rounded-lg transition-colors text-sm flex items-center gap-2">
                                <i class="fas fa-camera"></i>
                                <span>Seleccionar Nueva Foto</span>
                            </button>
                            <p class="text-[10px] text-gray-500 mt-1.5 uppercase tracking-wide">JPG, PNG o WEBP. Max 5MB.</p>
                        </div>
                    </div>
                    @error('avatar') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Logo & Favicon row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Logo Global</label>
                    <div x-data="{ 
                            logoName: null, 
                            logoPreview: null,
                         }" 
                         class="flex items-center gap-4">
                        
                        <input type="file" name="logo" class="hidden" x-ref="logo"
                               accept="image/*"
                               @change="
                                    logoName = $refs.logo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { logoPreview = e.target.result; };
                                    reader.readAsDataURL($refs.logo.files[0]);
                               ">
                               
                        <div class="relative w-14 h-14 rounded-xl overflow-hidden bg-gray-900 border-2 border-indigo-500/30 flex-shrink-0 flex items-center justify-center" x-show="!logoPreview">
                            @if($user->logo)
                                <img src="{{ Str::startsWith($user->logo, 'http') ? $user->logo : asset('storage/' . $user->logo) }}" alt="Logo" class="w-full h-full object-contain p-1">
                            @else
                                <div class="w-full h-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="relative w-14 h-14 rounded-xl overflow-hidden bg-gray-900 border-2 border-emerald-500 flex-shrink-0 flex items-center justify-center" x-show="logoPreview" style="display: none;">
                            <img :src="logoPreview" class="w-full h-full object-contain p-1">
                        </div>
                        
                        <div class="flex-1">
                            <button type="button" @click.prevent="$refs.logo.click()" class="bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 font-medium px-4 py-2 rounded-lg transition-colors text-sm flex items-center gap-2">
                                <i class="fas fa-upload"></i>
                                <span>Subir Logo</span>
                            </button>
                            <p class="text-[10px] text-gray-500 mt-1.5 uppercase tracking-wide">Transparente recomendado.</p>
                        </div>
                    </div>
                    @error('logo') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Favicon -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Favicon</label>
                    <div x-data="{ 
                            favName: null, 
                            favPreview: null,
                         }" 
                         class="flex items-center gap-4">
                        
                        <input type="file" name="favicon" class="hidden" x-ref="favicon"
                               accept="image/png,image/x-icon"
                               @change="
                                    favName = $refs.favicon.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { favPreview = e.target.result; };
                                    reader.readAsDataURL($refs.favicon.files[0]);
                               ">
                               
                        <div class="relative w-14 h-14 rounded-xl overflow-hidden bg-gray-900 border-2 border-indigo-500/30 flex-shrink-0 flex items-center justify-center" x-show="!favPreview">
                            @if($user->favicon)
                                <img src="{{ Str::startsWith($user->favicon, 'http') ? $user->favicon : asset('storage/' . $user->favicon) }}" alt="Favicon" class="w-8 h-8 object-contain">
                            @else
                                <div class="w-full h-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                    <i class="fas fa-globe text-xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="relative w-14 h-14 rounded-xl overflow-hidden bg-gray-900 border-2 border-emerald-500 flex-shrink-0 flex items-center justify-center" x-show="favPreview" style="display: none;">
                            <img :src="favPreview" class="w-8 h-8 object-contain">
                        </div>
                        
                        <div class="flex-1">
                            <button type="button" @click.prevent="$refs.favicon.click()" class="bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 font-medium px-4 py-2 rounded-lg transition-colors text-sm flex items-center gap-2">
                                <i class="fas fa-bookmark"></i>
                                <span>Subir Favicon</span>
                            </button>
                            <p class="text-[10px] text-gray-500 mt-1.5 uppercase tracking-wide">Formatos .ICO o .PNG (32x32)</p>
                        </div>
                    </div>
                    @error('favicon') <p class="text-rose-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Biografía</label>
                <textarea name="bio" rows="3"
                          class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-y"
                          placeholder="Cuéntale al mundo sobre ti...">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">GitHub</label>
                    <input type="text" name="github_url" value="{{ old('github_url', $user->github_url) }}"
                           class="w-full bg-gray-700 border @error('github_url') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="https://github.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">LinkedIn</label>
                    <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}"
                           class="w-full bg-gray-700 border @error('linkedin_url') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="https://linkedin.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Twitter / X</label>
                    <input type="text" name="twitter_url" value="{{ old('twitter_url', $user->twitter_url) }}"
                           class="w-full bg-gray-700 border @error('twitter_url') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="https://twitter.com/...">
                </div>
            </div>

            <div class="pt-4 border-t border-gray-700">
                <h3 class="text-md font-semibold text-white mb-4">Mi Stack Favorito</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Backend</label>
                        <input type="text" name="stack_backend" value="{{ old('stack_backend', $user->stack_backend) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="ej: Laravel, Node.js">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Frontend</label>
                        <input type="text" name="stack_frontend" value="{{ old('stack_frontend', $user->stack_frontend) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="ej: Vue.js, React">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Database</label>
                        <input type="text" name="stack_database" value="{{ old('stack_database', $user->stack_database) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="ej: MySQL, PostgreSQL">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">DevOps</label>
                        <input type="text" name="stack_devops" value="{{ old('stack_devops', $user->stack_devops) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="ej: Docker, AWS">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Guardar Perfil
                </button>
            </div>
        </form>
    </div>

    {{-- Password Change --}}
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <h2 class="text-lg font-semibold text-white mb-5">Cambiar Contraseña</h2>
        <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Nueva contraseña</label>
                <input type="password" name="password"
                       class="w-full bg-gray-700 border @error('password') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Mínimo 8 caracteres">
                @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Confirmar contraseña</label>
                <input type="password" name="password_confirmation"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium px-6 py-2.5 rounded-lg transition-colors">
                    Actualizar Contraseña
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
