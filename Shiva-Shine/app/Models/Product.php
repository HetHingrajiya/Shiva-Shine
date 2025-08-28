<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'category_id', 'image1', 'image2', 'image3', 'image4', 'image5', 'description','category'];

    /**
     * Get the category this product belongs to.
     */
   public function category()
   {
       return $this->belongsTo(Category::class, 'category_id');
   }


}
