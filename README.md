# Portafolio Personal

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white)
![Three.js](https://img.shields.io/badge/Three.js-3D-black?logo=threedotjs&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?logo=tailwind-css&logoColor=white)
![Live](https://img.shields.io/badge/Live-portafolio.americolabs.com-green)

> Portfolio personal autoadministrable construido con Laravel 10. Incluye efectos 3D con Three.js, diseño glassmorphism, panel de administración CMS propio y optimización SEO.

**[Ver Demo →](https://portafolio.americolabs.com)**

[![Portfolio Preview](https://img.shields.io/badge/Ver_Demo_en_Vivo-portafolio.americolabs.com-blue?style=for-the-badge)](https://portafolio.americolabs.com)

---

## ✨ Características

- **Diseño glassmorphism** con efectos visuales modernos y animaciones CSS personalizadas
- **Escena 3D interactiva** renderizada con Three.js integrada en la vista principal
- **Panel de administración CMS** para gestionar proyectos, skills y experiencia sin tocar código
- **Contenido 100% dinámico** — toda la información se edita desde el panel admin
- **Responsive design** adaptado a mobile, tablet y desktop
- **SEO optimizado** — metadatos, estructura semántica y rendimiento

## 🛠️ Stack

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2+ / Laravel 10 |
| Frontend | Blade Templates, Alpine.js |
| Estilos | Tailwind CSS |
| 3D / Animaciones | Three.js, CSS personalizado |
| Base de datos | MySQL / PostgreSQL |
| Iconografía | FontAwesome 6, Heroicons |
| Deploy | portafolio.americolabs.com |

## 🚀 Instalación

**Requisitos previos:** PHP 8.2+, Composer, Node.js 18+

```bash
# 1. Clonar el repositorio
git clone https://github.com/mequito3/Portafolio-Personal.git
cd Portafolio-Personal

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS y compilar assets
npm install
npm run build

# 4. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
# DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Ejecutar migraciones
php artisan migrate --seed

# 7. Levantar servidor local
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

## 📁 Estructura

```
Portafolio-Personal/
├── app/
│   ├── Http/Controllers/     # Controladores frontend y admin
│   └── Models/               # Proyecto, Skill, Experiencia
├── resources/
│   ├── views/
│   │   ├── portfolio/        # Vistas públicas del portfolio
│   │   └── admin/            # Panel de administración
│   └── js/                   # Three.js y Alpine.js
├── routes/
│   ├── web.php               # Rutas públicas
│   └── admin.php             # Rutas del panel admin
└── database/migrations/      # Esquema de contenido dinámico
```

## 🎛️ Personalización vía Panel Admin

Todo el contenido del portfolio se gestiona desde el panel de administración, sin necesidad de modificar código:

- **Proyectos** — Agregar, editar o eliminar proyectos con imagen, descripción, tecnologías y links
- **Skills** — Gestionar el listado de habilidades técnicas con niveles y categorías
- **Experiencia** — Actualizar el historial profesional y formación académica

Acceso al panel: `http://localhost:8000/admin` (requiere credenciales de administrador)

## 📝 Estado

✅ En producción — [portafolio.americolabs.com](https://portafolio.americolabs.com)

Último update: Marzo 2026

## 📄 Licencia

Este proyecto es de uso personal. El código puede servir de referencia, pero el diseño y contenido pertenecen al autor.

## 👤 Autor

**Américo Álvarez** — Desarrollador Full-Stack & Especialista en Automatizaciones con IA

- GitHub: [@mequito3](https://github.com/mequito3)
- Portfolio: [portafolio.americolabs.com](https://portafolio.americolabs.com)
- Email: americooficial23@gmail.com
