<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    /* --- Scopes --- */

    public function scopeTerlaksana($query)
    {
        return $query->where('status', 'terlaksana');
    }

    public function scopeRencana($query)
    {
        return $query->where('status', 'rencana');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('date')->orderByDesc('id');
    }

    /* --- Helpers --- */

    /**
     * Check if the expense has been executed.
     */
    public function isTerlaksana(): bool
    {
        return $this->status === 'terlaksana';
    }
}
