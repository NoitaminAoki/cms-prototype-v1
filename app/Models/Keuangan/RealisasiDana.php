<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'format_code', 
        'kwitansi_id', 
        'pengajuan_dana_id',	
        'divisi_id',
        'asal',
        'keterangan',
        'jumlah', 
        'bukti_transfer_path', 
        'status', 
    ];
    
    public function divisi()
    {
        return $this->belongsTo(MsCode::class, 'divisi_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanDana::class, 'pengajuan_dana_id');
    }

    public function material_pengajuans()
    {
        return $this->hasMany(MaterialPengajuanDana::class, 'pengajuan_dana_id', 'pengajuan_dana_id');
    }

    protected static function boot()
    {
        parent::boot();

        Self::creating(function ($model) {
           $model->format_code = 'RID-'.date('ymdHis'); 
        });
    }
}
