<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('produk', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $point = Product::find($request->id)->point;
        $data = [
            'id' => $request->id,
            'type' => 'product',
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'point' => $point,
            'total_price' => $request->price * $request->quantity,
        ];

        $cart = session()->get('cart', []);
        $existingItemIndex = -1;

        if (isset($cart[$data['id']])) {
            foreach ($cart as $index => $item) {
                if ($item['id'] == $data['id'] && $item['type'] == 'product') {
                    $existingItemIndex = $index;
                    break;
                }
            }
        }

        if ($existingItemIndex != -1) {
            $cart[$existingItemIndex]['quantity'] += $data['quantity'];
            $cart[$existingItemIndex]['total_price'] = $cart[$existingItemIndex]['price'] * $cart[$existingItemIndex]['quantity'];
            $cart[$existingItemIndex]['point'] = $cart[$existingItemIndex]['point'] * $cart[$existingItemIndex]['quantity'];
        } else {
            $cart[] = $data;
        }

        session()->put('cart', $cart);
        return response()->json(["message" => "Product added to cart", "data" => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['id'] == $request->id && $item['type'] == 'product') {
                if ($item['quantity'] > 1) {
                    $cart[$index]['quantity'] -= 1;
                    $cart[$index]['total_price'] = $cart[$index]['price'] * $cart[$index]['quantity'];
                } else {
                    unset($cart[$index]);
                }
                break;
            }
        }

        $cart = array_values($cart);

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product removed from cart', 'data' => $cart]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }
}
