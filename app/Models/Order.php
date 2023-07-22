<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = ['user_id'];

    public function orderlines()
    {
        return $this->hasMany(OrderLine::class,'orderinfo_id');
    }
    public function getTotalAttribute()
{
    $total = 0;

    foreach ($this->orderlines as $orderline) {
        $total += $orderline->items->sellprice * $orderline->quantity;
    }

    return $total;
}
}
