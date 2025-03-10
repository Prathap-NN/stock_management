<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'sku',
        'quantity',
        'price' 
    ];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
