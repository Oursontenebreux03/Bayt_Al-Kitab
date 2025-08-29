<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'description',
        'summary',
        'target_audience',
        'highlights',
        'features',
        'pages',
        'format',
        'isbn',
        'price',
        'stock',
        'images',
        'excerpt_pdf',
        'language',
        'is_new',
        'is_popular',
        'is_on_sale',
        'sale_price',
        'audience',
    ];

    protected $casts = [
        'images' => 'array',
        'is_new' => 'boolean',
        'is_popular' => 'boolean',
        'is_on_sale' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->is_on_sale && $this->sale_price ? $this->sale_price : $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->is_on_sale && $this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeOnSale($query)
    {
        return $query->where('is_on_sale', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
