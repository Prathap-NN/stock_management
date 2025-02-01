<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    protected $table = 'stock_movement';

    public $timestamps = true;
    protected $fillable = ['product_id', 'type', 'quantity', 'remarks'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
