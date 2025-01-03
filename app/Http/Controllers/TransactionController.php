<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use Filament\Notifications\Notification;
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
                'quantities_menus' => 'array',
                'quantities_products' => 'array',
                'prices_menus' => 'array',
                'prices_products' => 'array',
                'table_number' => 'required|integer',
                'subtotal_prices_menus' => 'array',
                'subtotal_prices_products' => 'array',
                'total_points' => 'required|integer',
                'total_price' => 'required|integer',
                'voucher_code' => 'nullable|string',
            ]);

            DB::beginTransaction();

            $transaction = new Transaction();
            $transaction->invoice_number = 'INV-' . date('YmdHis') . '-' . str()->random(6);
            $transaction->table_number = $data['table_number'];
            $transaction->total_amount = $data['total_price'];
            $transaction->total_point = $data['total_points'];
            $transaction->created_at = now();
            $transaction->updated_at = now();
            if (auth()->check()) {
                $transaction->user_id = auth()->user()->id;
                $user = auth()->user();
                $user->points += $data['total_points'];
                $user->save();

                if ($data['voucher_code'] != null && $data['voucher_code'] != '') {
                    $voucher = Voucher::where('voucher_code', $data['voucher_code'])->first();
                    $user->vouchers()->attach($voucher->id, ['redeemed_at' => now()]);
                    $user->points -= $voucher->point_required;
                    $user->save();
                }
            }
            $transaction->save();

            if (!empty($data['menus'])) {
                foreach ($data['menus'] as $index => $menu) {
                    $transaction->menus()->attach($menu, [
                        'quantity' => $data['quantities_menus'][$index],
                        'price' => $data['prices_menus'][$index],
                        'subtotal' => $data['subtotal_prices_menus'][$index],
                        'menu_id' => $data['menus'][$index],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if (!empty($data['products'])) {
                foreach ($data['products'] as $index => $product) {
                    $transaction->products()->attach($product, [
                        'quantity' => $data['quantities_products'][$index],
                        'price' => $data['prices_products'][$index],
                        'subtotal' => $data['subtotal_prices_products'][$index],
                        'product_id' => $data['products'][$index],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();

            session()->forget('cart');

            $recipient = User::query()->where('role', 'admin')->first();
            Notification::make()
                ->title('Saved successfully')
                ->sendToDatabase($recipient);

            return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Transaction failed to create', 'error' => $exception->getMessage(), 'details' => $exception->getTrace(), 'line' => $exception->getLine()], 500);
        }
    }

    public function show($invoice_number)
    {
        $transaction = Transaction::where('invoice_number', $invoice_number)->first();
        return response()->json(['status' => $transaction->status]);
    }
}
