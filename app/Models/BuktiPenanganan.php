<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPenanganan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penanganan_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function penanganan()
    {
        return $this->belongsTo(Penanganan::class);
    }
}
