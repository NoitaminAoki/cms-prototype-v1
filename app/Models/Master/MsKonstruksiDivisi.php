<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Master\MsSatuan,
    Master\MsKonstruksiSubDivisi,
};

class MsKonstruksiDivisi extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'has_template_view', 
        'total_harga', 
    ];

    public function sub_divisis()
    {
        return $this->hasMany(MsKonstruksiSubDivisi::class, 'konstruksi_divisi_id');
    }
}
