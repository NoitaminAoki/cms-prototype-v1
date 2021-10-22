<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSubCode,
    Master\MsSubDivisiItem,

    Keuangan\RealisasiDana,
    Keuangan\MaterialPengajuanDana,
};

class PengajuanDana extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paket_id',
        'image_name', 
        'image_path', 
        'tanggal',
    ];
}
