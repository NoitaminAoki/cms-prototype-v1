<?php

namespace App\Models\Perencanaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Perencanaan\ListMaterialSubItem,
};

class SubItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'has_group', 
    ];

    public function materials()
    {
        return $this->hasMany(ListMaterialSubItem::class, 'sub_item_id', 'id');
    }

}
