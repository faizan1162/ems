<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = ['category_name','category_icon','is_active'];
    public function categoryProduct() {
        return $this->hasMany( Product::class, 'category_id' )
        ->where('qty','>',0)->where('is_active',1);
    }
}
