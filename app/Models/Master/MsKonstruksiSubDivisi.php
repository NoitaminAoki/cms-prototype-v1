<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSatuan,
    Master\MsSubDivisiItem,
};

class MsKonstruksiSubDivisi extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'konstruksi_divisi_id', 
        'sub_code_id', 
        'satuan_id', 
        'nama', 
        'jumlah', 
        'harga', 
        'total_harga', 
        'has_child', 
        'is_option', 
        'is_percentage', 
    ];

    public function ms_satuan()
    {
        return $this->belongsTo(MsSatuan::class, 'satuan_id');
    }

    public function items()
    {
        return $this->hasMany(MsSubDivisiItem::class, 'sub_divisi_id');
    }
}
