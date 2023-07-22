<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use App\Models\Category;
use App\Models\Supplier;

class Item extends Model implements HasMedia
{

    use HasFactory;
    use Searchable;
    use InteractsWithMedia;

    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ['item_name', 'sellprice', 'img_path', 'cat_id'];

    public function orderlines()
    {
        return $this->hasMany(Orderline::class, 'item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'item_name' => $this->item_name,

        ];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }
}
