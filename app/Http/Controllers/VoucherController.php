<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $point = auth()->user()->points;
            $vouchers = Voucher::query()
                ->whereDate('expired_date', '>=', now()->format('Y-m-d'))
                ->where('point_required', '<=', intval($point))
                ->whereDoesntHave('users', function ($query) {
                    $query->where('user_id', auth()->user()->id)
                        ->whereNotNull('redeemed_at');
                })
                ->get();
            return view('voucher', compact('vouchers'));
        }
        return redirect()->route('login');
    }
}
