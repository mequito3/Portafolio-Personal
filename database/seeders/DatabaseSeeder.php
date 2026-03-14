<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ────────────────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@portafolio.test'],
            [
                'name'         => 'Tu Nombre',
                'password'     => Hash::make('password'),
                'is_admin'     => true,
                'job_title'    => 'Desarrollador Full Stack',
                'bio'          => 'Soy un desarrollador apasionado por crear experiencias digitales increíbles. Con más de 5 años de experiencia en desarrollo web, me especializo en crear aplicaciones modernas y escalables.',
                'location'     => 'Ciudad de México, México',
                'phone'        => '+52 55 1234 5678',
                'github_url'   => 'https://github.com/tuusuario',
                'linkedin_url' => 'https://linkedin.com/in/tuusuario',
                'twitter_url'  => 'https://twitter.com/tuusuario',
            ]
        );

        // ── Projects ────────────────────────────────────────────────────────
        $projects = [
            [
                'title'       => 'E-Commerce Platform',
                'description' => 'Plataforma de comercio electrónico completa con carrito de compras, pagos y gestión de inventario.',
                'image'       => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop',
                'tags'        => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
                'github_url'  => 'https://github.com/tuusuario/ecommerce',
                'demo_url'    => '#',
                'is_featured' => true,
                'is_active'   => true,
                'order'       => 1,
            ],
            [
                'title'       => 'Task Management App',
                'description' => 'Aplicación de gestión de tareas con colaboración en tiempo real y notificaciones.',
                'image'       => 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=600&h=400&fit=crop',
                'tags'        => ['React', 'Node.js', 'Socket.io', 'MongoDB'],
                'github_url'  => '#',
                'demo_url'    => '#',
                'is_featured' => true,
                'is_active'   => true,
                'order'       => 2,
            ],
            [
                'title'       => 'AI Dashboard',
                'description' => 'Dashboard de análisis con inteligencia artificial para visualización de datos empresariales.',
                'image'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                'tags'        => ['Python', 'TensorFlow', 'React', 'D3.js'],
                'github_url'  => '#',
                'demo_url'    => '#',
                'is_featured' => false,
                'is_active'   => true,
                'order'       => 3,
            ],
            [
                'title'       => 'Portfolio 3D',
                'description' => 'Este mismo portafolio con elementos 3D interactivos y animaciones modernas.',
                'image'       => 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=600&h=400&fit=crop',
                'tags'        => ['Laravel', 'Three.js', 'Blade', 'Vite'],
                'github_url'  => '#',
                'demo_url'    => '#',
                'is_featured' => true,
                'is_active'   => true,
                'order'       => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(['title' => $project['title']], $project);
        }

        // ── Skills ─────────────────────────────────────────────────────────
        $skills = [
            // Frontend
            ['name' => 'HTML5',       'category' => 'frontend', 'level' => 98, 'order' => 1],
            ['name' => 'CSS3',        'category' => 'frontend', 'level' => 95, 'order' => 2],
            ['name' => 'JavaScript',  'category' => 'frontend', 'level' => 92, 'order' => 3],
            ['name' => 'TypeScript',  'category' => 'frontend', 'level' => 85, 'order' => 4],
            ['name' => 'React',       'category' => 'frontend', 'level' => 88, 'order' => 5],
            ['name' => 'Vue.js',      'category' => 'frontend', 'level' => 82, 'order' => 6],
            ['name' => 'Tailwind CSS','category' => 'frontend', 'level' => 92, 'order' => 7],
            ['name' => 'Three.js',    'category' => 'frontend', 'level' => 70, 'order' => 8],
            // Backend
            ['name' => 'PHP',         'category' => 'backend', 'level' => 93, 'order' => 1],
            ['name' => 'Laravel',     'category' => 'backend', 'level' => 95, 'order' => 2],
            ['name' => 'Node.js',     'category' => 'backend', 'level' => 80, 'order' => 3],
            ['name' => 'Python',      'category' => 'backend', 'level' => 75, 'order' => 4],
            ['name' => 'REST APIs',   'category' => 'backend', 'level' => 90, 'order' => 5],
            // Database
            ['name' => 'MySQL',       'category' => 'database', 'level' => 90, 'order' => 1],
            ['name' => 'PostgreSQL',  'category' => 'database', 'level' => 80, 'order' => 2],
            ['name' => 'MongoDB',     'category' => 'database', 'level' => 75, 'order' => 3],
            ['name' => 'Redis',       'category' => 'database', 'level' => 72, 'order' => 4],
            // DevOps
            ['name' => 'Git',         'category' => 'devops', 'level' => 92, 'order' => 1],
            ['name' => 'Docker',      'category' => 'devops', 'level' => 75, 'order' => 2],
            ['name' => 'Linux',       'category' => 'devops', 'level' => 78, 'order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(
                ['name' => $skill['name'], 'category' => $skill['category']],
                array_merge($skill, ['is_active' => true])
            );
        }

        // ── Experiences ────────────────────────────────────────────────────
        $experiences = [
            [
                'company'     => 'Tech Company S.A.',
                'position'    => 'Senior Full Stack Developer',
                'description' => 'Lideré desarrollo de aplicaciones web para clientes enterprise usando Laravel, React y AWS.',
                'start_date'  => '2022-01-01',
                'end_date'    => null,
                'is_current'  => true,
                'order'       => 1,
            ],
            [
                'company'     => 'Digital Agency',
                'position'    => 'Full Stack Developer',
                'description' => 'Desarrollé soluciones web personalizadas, integración de APIs y sistemas de gestión.',
                'start_date'  => '2020-03-01',
                'end_date'    => '2021-12-31',
                'is_current'  => false,
                'order'       => 2,
            ],
            [
                'company'     => 'Startup Inc.',
                'position'    => 'Junior Developer',
                'description' => 'Construí interfaces UI con React y Vue.js, colaborando en equipo ágil.',
                'start_date'  => '2019-01-01',
                'end_date'    => '2020-02-28',
                'is_current'  => false,
                'order'       => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::firstOrCreate(
                ['company' => $exp['company'], 'position' => $exp['position']],
                $exp
            );
        }
    }
}
