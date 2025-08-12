<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Allow these columns to be mass assignable
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description', // if you have it
        'image',       // if you have it
        'category_id'  // if you have it
    ];
}
