<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Models\{
    Master\MsCode,

    Keuangan\PengajuanDana,
    Keuangan\MaterialPengajuanDana,
};

class RealisasiDana extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'full_path',
        'sector_id',
        'image_real_name', 
        'image_name', 
        'base_path', 
        'tanggal',
    ];

    public const BASE_PATH = 'images/keuangan/realisasi-dana/';

    
    protected static function boot()
    {
        parent::boot();

        Self::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->sector_id = Config::get('app.sector_id'); 
            $model->base_path = self::BASE_PATH; 
            $model->full_path = self::BASE_PATH . $model->image_name;
        });
    }
}
