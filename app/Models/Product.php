<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Additional configuration (if needed)
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock_quantity',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
