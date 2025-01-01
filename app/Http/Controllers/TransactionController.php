<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'menus' => 'required|array',
                'quantities' => 'required|array',
                'prices' => 'required|array',
                'table_number' => 'required|integer',
                'subtotal_prices' => 'required|array',
                'total_points' => 'required|integer',
                'total_price' => 'required|integer',
            ]);

            $transaction = new Transaction();
            $transaction->invoice_number = 'INV-' . date('YmdHis') . str()->random(6);
            $transaction->table_number = $data['table_number'];
            $transaction->total_amount = $data['total_price'];
            $transaction->total_point = $data['total_points'];
            $transaction->user_id = auth()->user()->id;
            $transaction->save();

            foreach ($data['menus'] as $index => $menu) {
                $transaction->menus()->attach($menu, [
                    'quantity' => $data['quantities'][$index],
                    'price' => $data['prices'][$index],
                    'subtotal' => $data['subtotal_prices'][$index],
                    'menu_id' => $data['menus'][$index],
                ]);
            }

            return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Transaction failed to create', 'error' => $exception->getMessage(), 'details' => $exception->getTrace()], 500);
        }
    }
}
