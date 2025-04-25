<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $guarded = [];


    protected static function booted()
    {
        static::updating(function ($item) {
            if ($item->isDirty('stock') && $item->stock == 0) {
                $item->status = 0;
            }
        });
    }
    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function getImageAttribute($value)
    {
        if (!$value) {
            return asset('assets/images/product.webp');
        } else if (Storage::disk('public')->exists($value)) {
            return '/storage/' . $value;
        }
        
        return asset('assets/images/product.webp');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value);
    }





    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
