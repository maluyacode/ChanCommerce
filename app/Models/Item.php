<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Category;
class Item extends Model
{
    
    use HasFactory;
    use Searchable;
    public function toSearchableArray()
    {
        // Define the searchable attributes for the model
        return [
            'id' => $this->id,
            'item_name' => $this->item_name,
            
        ];
    }
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ['item_name', 'sellprice', 'img_path','cat_id'];

    public function orderlines()
    {
        return $this->hasMany(Orderline::class,'item_id');
    }
}
