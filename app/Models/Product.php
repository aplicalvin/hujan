<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $guarded = ['id'];

    public function transaction_item_products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'transaction_items', 'product_id', 'id');
    }
}
