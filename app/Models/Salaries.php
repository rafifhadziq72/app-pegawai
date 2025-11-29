<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salaries extends Model
{
    protected $table = 'salaries';
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
    ];


    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'karyawan_id', 'id');
    }

   
   
}
