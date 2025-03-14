<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart()
    {
        return response()->json(auth()->user()->cartItems()->with('product')->get());
    }

    public function addToCart(Request $request)
    {
        $cartItem = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $request->product_id],
            ['quantity' => DB::raw("quantity + " . (int)$request->quantity)]
        );

        // Re-fetch to ensure corre ct quantity in JSON response
        $cartItem = Cart::find($cartItem->id);

        return response()->json($cartItem);
    }


    // public function addToCart(Request $request)
    // {
    //     $cartItem = Cart::where('user_id', auth()->id())
    //         ->where('product_id', $request->product_id)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->increment('quantity', $request->quantity);
    //     } else {
    //         // Create new cart item if not exists
    //         $cartItem = Cart::create([
    //             'user_id'    => auth()->id(),
    //             'product_id' => $request->product_id,
    //             'quantity'   => $request->quantity,
    //         ]);
    //     }

    //     return response()->json($cartItem);
    // }



}
