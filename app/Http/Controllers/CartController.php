<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', 1)->get();
        return view('cart', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        $cartItem = Cart::where('product_id', $product->id)
            ->where('user_id', 1)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->product_price = $product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                'user_id' => 1,
                'quantity' => 1,
                'product_price' => $product->price,
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update(['quantity' => $validatedData['quantity']]);
        $productPrice = $cart->product->price;
        $newPrice = $productPrice * $cart->quantity;
        $cart->product_price = $newPrice;
        $cart->save();
        $formattedPrice = number_format($newPrice, 2, '.', '');

        return response()->json([
            'message' => 'Cart updated',
            'cart' => $cart,
            'newPrice' => $formattedPrice, // Оновлена ціна
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Product removed successfully'], 200);
    }
}
