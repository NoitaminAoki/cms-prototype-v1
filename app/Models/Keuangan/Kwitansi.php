<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Keuangan\RealisasiDana,
};

class Kwitansi extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'format_code', 
        'penerima', 
        'penanggung_jawab',	
        'total_jumlah',	
    ];

    public function realisasi_danas()
    {
        return $this->hasMany(RealisasiDana::class, 'kwitansi_id');
    }

    protected static function boot()
    {
        parent::boot();

        Self::creating(function ($model) {
           $model->format_code = 'KWD-'.date('ymdHis'); 
        });
    }
}
