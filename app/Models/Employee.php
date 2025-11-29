<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import the correct interface

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_masuk',
    ];

    

    // Relationship with Department
    public function department(): BelongsTo // Add correct return type for department too
    {
        return $this->belongsTo(\App\Models\Department::class, 'departemen_id');
    }

    // Relationship with Position
    public function position(): BelongsTo // Add correct return type for position too
    {
        return $this->belongsTo(\App\Models\Position::class, 'jabatan_id');
    }

    // Relationship with Salaries - CORRECTED RETURN TYPE HINT
    public function salaries(): \Illuminate\Database\Eloquent\Relations\HasMany // Use FQCN
    {
        return $this->hasMany(\App\Models\Salaries::class, 'karyawan_id'); // Ensure Salaries model is correctly referenced
    }
}