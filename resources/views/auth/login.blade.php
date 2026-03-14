<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <p class="text-gray-400 mt-1">Inicia sesión para administrar tu portafolio</p>
        </div>

        <div class="bg-gray-800 rounded-2xl p-8 shadow-2xl border border-gray-700">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-700 border @error('email') border-red-500 @else border-gray-600 @enderror rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="admin@portafolio.test">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Contraseña</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="••••••••">
                </div>

                {{-- Remember --}}
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-indigo-600 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-400">Recordarme</label>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                    Iniciar Sesión
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            <a href="{{ route('portfolio.index') }}" class="text-indigo-400 hover:underline">
                ← Volver al portafolio
            </a>
        </p>
    </div>

</body>
</html>
