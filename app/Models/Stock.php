<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';

    protected $fillable = ['item_id', 'quantity'];

    protected $primaryKey = "item_id";
    public $timestamps = false;
}
