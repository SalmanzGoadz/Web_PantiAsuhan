<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'date',
        'is_anonymous',
        'proof_image',
        'status',
        'prayer',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
            'is_anonymous' => 'boolean',
        ];
    }

    /* --- Relationships --- */

    /**
     * Relasi ke user (donatur terdaftar).
     * Null jika donasi diinput manual oleh admin.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* --- Scopes --- */

    /**
     * Scope: hanya donasi yang sudah tervalidasi.
     */
    public function scopeTervalidasi($query)
    {
        return $query->where('status', 'tervalidasi');
    }

    /**
     * Scope: hanya donasi yang masih menunggu validasi.
     */
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('date')->orderByDesc('id');
    }

    /* --- Accessors --- */

    /**
     * Nama tampilan — tampilkan "Hamba Allah" jika anonim.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->is_anonymous ? 'Hamba Allah' : $this->name;
    }

    /**
     * URL lengkap untuk mengakses bukti transfer.
     * Mengembalikan null jika tidak ada bukti.
     */
    public function getProofImageUrlAttribute(): ?string
    {
        if (!$this->proof_image) {
            return null;
        }

        return asset('storage/' . $this->proof_image);
    }

    /**
     * Cek apakah donasi berasal dari web (donatur terdaftar).
     * Donasi dari web memiliki user_id yang terisi.
     */
    public function isDariWeb(): bool
    {
        return !is_null($this->user_id);
    }

    /**
     * Cek apakah donasi diinput manual oleh admin.
     */
    public function isDariAdmin(): bool
    {
        return is_null($this->user_id);
    }

    /**
     * Cek apakah donasi sudah tervalidasi.
     */
    public function isTervalidasi(): bool
    {
        return $this->status === 'tervalidasi';
    }
}
