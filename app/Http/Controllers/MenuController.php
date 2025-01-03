<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::query()->with('menus')->get();
        return view('menu', compact('categories'));
    }

    public function addToCart(Request $request)
    {
        $point = Menu::find($request->id)->point;
        $data = [
            'id' => $request->id,
            'type' => 'menu',
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
                if ($item['id'] == $data['id'] && $item['type'] == 'menu') {
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
        return response()->json(["message" => "Menu added to cart", "data" => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['id'] == $request->id && $item['type'] == 'menu') {
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

        return response()->json(['message' => 'Menu removed from cart', 'data' => $cart]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }
}
