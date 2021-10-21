<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Perencanaan\MaterialDetail,

    Keuangan\MaterialRealisasiDana,
};

class MaterialPengajuanDana extends Model
{
    use HasFactory;

    protected $table = 'material_pengajuan_danas';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pengajuan_dana_id', 
        'material_detail_id', 
        'harga_satuan', 
        'total_harga', 
        'jumlah', 
    ];

    public function material()
    {
        return $this->belongsTo(MaterialDetail::class, 'material_detail_id');
    }

    public function material_realisasi()
    {
        return $this->belongsTo(MaterialRealisasiDana::class, 'id', 'material_pengajuan_dana_id')
        ->withDefault(['jumlah' => 0]);
    }
}
