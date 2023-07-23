<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Shipper;
use App\Models\PaymentMethod;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = ['user_id'];

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->orderlines as $orderline) {
            $total += $orderline->items->sellprice * $orderline->quantity;
        }

        return $total;
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'orderlines', 'orderinfo_id', 'item_id')->withPivot('quantity');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'id');
    }
    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'ship_id', 'id');
    }
    public function paymentmethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'pm_id', 'id');
    }
}
