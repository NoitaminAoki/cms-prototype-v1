<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRealisasiDana extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realisasi_dana_id', 
        'material_pengajuan_dana_id', 
        'material_detail_id', 
        'jumlah', 
    ];
}
