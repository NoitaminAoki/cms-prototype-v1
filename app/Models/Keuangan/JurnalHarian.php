<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;

class JurnalHarian extends Model
{
    use HasFactory, MultiTenantModelTrait;
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

    public const MENU = 'Pelaksanaan';
    public const DIVISI = 'Keuangan';
    public const BASE_PATH = 'images/keuangan/jurnal-harian/';

}
