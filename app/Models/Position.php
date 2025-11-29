<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok', // This must match your DB column name exactly: gaji_pokok
    ];

    // Optional: Define the inverse relationship to Employee if needed elsewhere
    public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Employee::class, 'jabatan_id', 'id');
    }
}