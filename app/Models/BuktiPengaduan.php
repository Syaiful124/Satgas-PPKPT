<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengaduan_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
