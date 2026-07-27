<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'date',
        'is_anonymous',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
            'is_anonymous' => 'boolean',
        ];
    }

    /* --- Scopes --- */

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('date')->orderByDesc('id');
    }

    /* --- Accessors --- */

    /**
     * Get the display name — shows "Hamba Allah" if anonymous.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->is_anonymous ? 'Hamba Allah' : $this->name;
    }
}
