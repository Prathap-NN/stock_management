<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    protected $table = 'stock_movement';

    // If you're using the default timestamps, you don't need to set these:
    public $timestamps = true;
    protected $fillable = ['product_id', 'type', 'quantity', 'remarks'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
