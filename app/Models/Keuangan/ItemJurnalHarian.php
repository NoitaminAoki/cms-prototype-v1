<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSubCode,
};

class ItemJurnalHarian extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'paket_id',
        'nama',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal',
    ];

    public function paket()
    {
        return $this->belongsTo(MsSubCode::class, 'paket_id');
    }
}
