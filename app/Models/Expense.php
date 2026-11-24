<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'purchase_id',
        'title',
        'category',
        'amount',
        'expense_date',
        'description',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}