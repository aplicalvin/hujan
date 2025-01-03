<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, table: 'user_vouchers')->withPivot('user_id', 'voucher_id', 'redeemed_at');
    }
}
