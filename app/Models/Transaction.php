<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'transaction_items')->withPivot('quantity', 'price', 'subtotal', 'product_id', 'menu_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_items')->withPivot('quantity', 'price', 'subtotal', 'product_id', 'menu_id');
    }
}
