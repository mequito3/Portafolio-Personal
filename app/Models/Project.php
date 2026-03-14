<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'images',
        'tags',
        'github_url',
        'demo_url',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'tags'        => 'array',
        'images'      => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'order'       => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    // Accessor: tags as comma string for form
    protected function tagsString(): Attribute
    {
        return Attribute::make(
            get: fn () => is_array($this->tags) ? implode(', ', $this->tags) : '',
        );
    }
}
