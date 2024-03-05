<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }



    public function tags()

    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');

    }

    public function getImageUrlAttribute()
    {
        if (!$this->image){
            return "https://www.google.com/url?sa=i&url=https%3A%2F%2Fboschbrandstore.com%2Fproduct%2Fdetergent%2F&psig=AOvVaw1H9-WiLYqGkNYZpYn1l38-&ust=1709563783032000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCNCe5MSr2IQDFQAAAAAdAAAAABAE";

        }elseif ( str::startsWith($this->image,'https://','http://')){

            return  $this->image;
        }else{

            return asset('storage/images/categories_images/'.$this->image);
        }

    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price){

            return 0;
        }else{

            return number_format(100-(100 *  $this->price/$this->compare_price));
        }


    }
}
