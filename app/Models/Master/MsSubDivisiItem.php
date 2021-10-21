<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSatuan,
};

class MsSubDivisiItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_divisi_id', 
        'satuan_id', 
        'nama', 
        'jumlah', 
        'harga', 
        'total_harga', 
        'is_calculated_price',  
    ];
    
    public function ms_satuan()
    {
        return $this->belongsTo(MsSatuan::class, 'satuan_id');
    }
}
