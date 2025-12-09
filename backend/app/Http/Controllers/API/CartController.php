<?php
namespace App\Http\Controllers\API;

use App\DTOs\Cart\CartItemData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\AddCartItemRequest;
use App\Http\Requests\Api\Cart\UpdateCartItemRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function __construct(private CartService $cartService){}

    protected function userId(): ?int
    {
        return auth()->check() ? auth()->id() : null;
    }

    protected function sessionId(): ?string
    {
        return session()->getId();
    }

    public function getCartItems(Request $request)
    {
        $cartItems = $this->cartService->getCartItems($this->userId() , $this->sessionId());
        return CartResource::collection($cartItems);
    }
    public function addToCart(AddCartItemRequest $request)
    {
        $validated = $request->validated();

        $cartItemData = new CartItemData(
            id: null,
            userId: $this->userId(),
            sessionId: $this->sessionId(),
            productId: $validated['product_id'],
            quantity: $validated['quantity'],
            meta: $validated['meta'] ?? null,
            price: $validated['price'] ?? 0
        );

        $cartItem = $this->cartService->addItem($cartItemData);
        return response()->json($cartItem);
    }

   public function updateCart(UpdateCartItemRequest $request , $id)
   {
        $data = $request->validated();
        $item = $this->cartService->updateItem($id , $data);

        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart_item' => $item
        ]);
   }

    public function removeFromCart($id){
        $this->cartService->removeItem($id);
        return response()->json(['message' => 'Item removed successfully']);
    }

}
