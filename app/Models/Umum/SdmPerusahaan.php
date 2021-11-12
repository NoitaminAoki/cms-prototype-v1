<?php

namespace App\Models\Umum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;

class SdmPerusahaan extends Model
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

    public const DIVISI = 'Umum';
    public const BASE_PATH = 'images/umum/sdm-perusahaan/';
}
