<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;
use App\Models\{
    Master\MsSubCode,
};

class PengajuanDana extends Model
{
    use HasFactory, MultiTenantModelTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'full_path',
        'divisi_id',
        'paket_id',
        'sector_id',
        'image_real_name', 
        'image_name', 
        'base_path', 
        'tanggal',
    ];

    public const DIVISI = 'Keuangan';
    public const BASE_PATH = 'images/keuangan/pengajuan-dana/';

    public function paket()
    {
        return $this->belongsTo(MsSubCode::class, 'paket_id');
    }
}
