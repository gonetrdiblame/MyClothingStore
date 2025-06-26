<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nume',
        'descriere',
        'pret',
        'stoc',
        'tip',
        'beneficii',
        'categorie_id'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }
}
