<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'views_count',
        'likes_count',
        'interests',
        'is_active',
        'stock_quantity',
        'category_id'
    ];

    protected $translatable = [
        'name',
        'description'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'price' => 'decimal:2',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'interests' => 'array',
        'is_active' => 'boolean',
        'stock_quantity' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toggleStatus()
    {
        $this->is_active = !$this->is_active;
        return $this->save();
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')->singleFile();
        $this->addMediaCollection('product_gallery');
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
} 