<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'category',
        'stock',
        'unit',
        'min_stock',
        'last_price',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}