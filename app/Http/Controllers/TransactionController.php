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
                'menus' => 'array',
                'products' => 'array',
                'quantities' => 'required|array',
                'prices' => 'required|array',
                'table_number' => 'required|integer',
                'subtotal_prices' => 'required|array',
                'total_points' => 'required|integer',
                'total_price' => 'required|integer',
            ]);

            DB::beginTransaction();
            $transaction = new Transaction();
            $transaction->invoice_number = 'INV-' . date('YmdHis') . '-' . str()->random(6);
            $transaction->table_number = $data['table_number'];
            $transaction->total_amount = $data['total_price'];
            $transaction->total_point = $data['total_points'];
            if (auth()->check()) {
                $transaction->user_id = auth()->user()->id;
            }
            $transaction->save();

            if (!empty($data['menus'])) {
                foreach ($data['menus'] as $index => $menu) {
                    $transaction->menus()->attach($menu, [
                        'quantity' => $data['quantities'][$index],
                        'price' => $data['prices'][$index],
                        'subtotal' => $data['subtotal_prices'][$index],
                        'menu_id' => $data['menus'][$index],
                    ]);
                }
            }

            if (!empty($data['products'])) {
                foreach ($data['products'] as $index => $product) {
                    $transaction->products()->attach($product, [
                        'quantity' => $data['quantities'][$index],
                        'price' => $data['prices'][$index],
                        'subtotal' => $data['subtotal_prices'][$index],
                        'product_id' => $data['products'][$index],
                    ]);
                }
            }

            DB::commit();

            session()->flush();

            return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Transaction failed to create', 'error' => $exception->getMessage(), 'details' => $exception->getTrace(), 'line' => $exception->getLine()], 500);
        }
    }
}
