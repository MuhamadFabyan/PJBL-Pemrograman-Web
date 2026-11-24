<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id',
        'ingredient_id',
        'quantity',
        'unit_price',
        'total_price',
        'purchase_date',
        'notes',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function expense()
    {
        return $this->hasOne(Expense::class);
    }
}