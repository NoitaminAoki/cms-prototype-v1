<?php

namespace App\Models\Perencanaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSatuan,
    Master\MsNestedSubCode,
};

class MaterialDetail extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_material', 
        'nested_sub_code_id', 
        'volume', 
        'satuan_id', 
        'harga_satuan'
    ];

    public function ms_satuan()
    {
        return $this->belongsTo(MsSatuan::class, 'satuan_id');
    }
    
    public function ms_item_code()
    {
        return $this->belongsTo(MsNestedSubCode::class, 'nested_sub_code_id');
    }
}
