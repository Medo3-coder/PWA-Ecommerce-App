<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\Store;
use App\Http\Requests\Reviews\Update;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {


    public function index($productId) {
        $reviews = Review::with('user')->where('product_id', $productId)->limit(5)->get();
        return response()->json($reviews);
    }

    public function store(Store $request) {
        $data = $request->validated();
        $data['user_id']  = auth()->id();
        $review = Review::create($data);
        return response()->json($review, 201);
    }

    public function update(Update $request, $id) {
        $review = Review::findOrFail($id);
        if ($review->user_id !==  Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $review->update($request->validated());
        return response()->json($review);
    }

    public function destroy($id) {
        $review = Review::findOrFail($id);

        if ($review->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $review->delete();
        return response()->json(['message' => 'Review deleted']);
    }

}
