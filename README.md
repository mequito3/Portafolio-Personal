# 🚀 Premium Developer Portfolio - Americo Labs



Una plataforma de portafolio moderna, elegante y de alto rendimiento construida con **Laravel 10**, diseñada para impresionar con una estética **Cyberpunk-Glassmorphism** y efectos 3D dinámicos.

🔗 **Demo en vivo:** [portafolio.americolabs.com](https://portafolio.americolabs.com/)

---

## ✨ Características Principales

### 🎨 Diseño Frontend (Visual Excellence)
- **Glassmorphism Puro**: Interfaz ultra-moderna con efectos de desenfoque y transparencias.
- **Micro-interacciones**: Animaciones suaves usando Tailwind CSS y Alpine.js.
- **Fondo 3D Interactivo**: Experiencia inmersiva integrada con Three.js.
- **Totalmente Responsivo**: Optimización específica para móviles, tablets y escritorio.
- **Dark Mode Nativo**: Paleta de colores curada con acentos Neón (Cyan y Magenta).

### 🛠️ Panel de Administración (Full Control)
- **Gestión de Proyectos**: CRUD completo con soporte para imágenes, etiquetas y estados.
- **Gestión de Habilidades**: Sistema de habilidades categorizadas con nivel de dominio.
- **Experiencia Laboral**: Historial profesional ordenable y dinámico.
- **Centro de Mensajes**: Gestión de contactos entrantes con notificaciones Toast.
- **Configuración de Perfil**: Control total sobre logos, favicons, redes sociales y stack tecnológico.

### 🧠 Innovación & Estabilidad
- **Sugerencias IA**: Autocompletado inteligente de tecnologías y habilidades en el admin.
- **Integridad de Datos**: Validaciones robustas para prevenir errores de base de datos.
- **Carga Optimizada**: Uso eficiente de recursos y almacenamiento local.

---

## 🛠️ Stack Tecnológico

- **Core:** [Laravel 10](https://laravel.com/)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com/) & [Alpine.js](https://alpinejs.dev/)
- **Efectos 3D:** [Three.js](https://threejs.org/)
- **Base de Datos:** MySQL / PostgreSQL
- **Iconos:** FontAwesome 6 & Heroicons

---

## 🚀 Instalación y Configuración

Sigue estos pasos para poner en marcha tu portafolio localmente:

### 1. Requisitos Previos
- PHP >= 8.1
- Composer
- Node.js & NPM
- Servidor MySQL (Laragon recomendado)

### 2. Clonar e Instalar Dependencias
```bash
# Instalar dependencias de PHP
composer install

# Instalar dependencias de JS
npm install && npm run dev
```

### 3. Configuración de Entorno
```bash
# Crear archivo .env
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```
*Configura las credenciales de tu base de datos en el archivo `.env`.*

### 4. Base de Datos y Almacenamiento
```bash
# Ejecutar migraciones
php artisan migrate

# Crear enlace simbólico para imágenes
php artisan storage:link
```

### 5. Iniciar Servidor
```bash
php artisan serve
```
Visita `http://127.0.0.1:8000` para ver tu portafolio.

---

## 📸 Demo Visual

> [!TIP]
> Puedes personalizar todos los logos y colores desde el panel de administración en `/admin/profile`.


---

## 📝 Licencia

Este proyecto está bajo la licencia MIT. Hecho con ❤️ por Americo Labs.
