<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'discount_price',
        'stock',
        'is_active',
        'is_featured',
        'image_url',
        'gallery_images',
        'sizes',
        'colors'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sizes' => 'array',
        'colors' => 'array',
        'gallery_images' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value);
        }
        return asset('images/default-product.png');
    }

    public function getGalleryImagesAttribute($value)
    {
        if (!$value) {
            return [];
        }

        $images = is_string($value) ? json_decode($value, true) : $value;
        
        if (!is_array($images)) {
            return [];
        }

        return array_map(function($image) {
            return asset('storage/'.$image);
        }, $images);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}