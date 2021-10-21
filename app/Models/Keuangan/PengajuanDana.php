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
        'divisi_id', 
        'paket_id',	
        'sub_divisi_item_id',
        'keterangan',
        'pembuat_pengajuan', 
        'total_harga_material', 
        'status_pengajuan', 
    ];
    
    public function realisasi()
    {
        return $this->belongsTo(RealisasiDana::class, 'id', 'pengajuan_dana_id');
    }

    public function paket()
    {
        return $this->belongsTo(MsSubCode::class, 'paket_id');
    }
    public function item()
    {
        return $this->belongsTo(MsSubDivisiItem::class, 'sub_divisi_item_id');
    }
    
    public function material_pengajuans()
    {
        return $this->hasMany(MaterialPengajuanDana::class, 'pengajuan_dana_id');
    }
}
