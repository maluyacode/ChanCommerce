<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    protected $table = 'orderlines';
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class,'orderinfo_id');
    }
    public function items()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
