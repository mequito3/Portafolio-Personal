<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'level'     => 'integer',
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    // Category labels
    public static array $categories = [
        'frontend'  => 'Frontend',
        'backend'   => 'Backend',
        'database'  => 'Base de datos & Herramientas',
        'devops'    => 'DevOps & Cloud',
        'mobile'    => 'Mobile',
        'other'     => 'Otros',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::$categories[$this->category] ?? ucfirst($this->category);
    }
}
