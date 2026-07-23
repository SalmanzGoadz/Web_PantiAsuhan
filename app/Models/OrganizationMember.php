<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'parent_id',
        'sort_order',
        'level',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'level' => 'integer',
        ];
    }

    /* --- Relationships --- */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Recursive children for building full tree.
     */
    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    /* --- Scopes --- */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('level')->orderBy('sort_order');
    }

    /* --- Accessors --- */

    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return null;
    }

    /* --- Static Helpers --- */

    /**
     * Build the full hierarchical tree for organization chart.
     */
    public static function getTree()
    {
        return self::active()
            ->roots()
            ->ordered()
            ->with('allChildren')
            ->get();
    }
}
