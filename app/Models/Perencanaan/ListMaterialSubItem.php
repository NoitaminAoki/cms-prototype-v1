<?php

namespace App\Models\Perencanaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Perencanaan\MaterialDetail,
    Perencanaan\SubItemGroup,
};

class ListMaterialSubItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_item_id', 
        'sub_item_group_id', 
        'material_detail_id', 
    ];
    
    public function material_detail()
    {
        return $this->belongsTo(MaterialDetail::class, 'material_detail_id');
    }
    
    public function group()
    {
        return $this->belongsTo(SubItemGroup::class, 'sub_item_group_id');
    }
}
