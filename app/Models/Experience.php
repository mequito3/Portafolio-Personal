<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'position',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
        'order'      => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderByDesc('start_date');
    }

    public function getPeriodAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end   = $this->is_current ? 'Presente' : $this->end_date?->format('M Y');
        return "{$start} - {$end}";
    }

    public function getDurationAttribute(): string
    {
        $end = $this->is_current ? now() : $this->end_date;
        if (!$end) {
            return '';
        }
        $diff = $this->start_date->diff($end);
        $years  = $diff->y;
        $months = $diff->m;

        if ($years > 0 && $months > 0) {
            return "{$years} año(s) {$months} mes(es)";
        }
        if ($years > 0) {
            return "{$years} año(s)";
        }
        return "{$months} mes(es)";
    }
}
