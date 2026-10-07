<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::paginate();
    }

    public function store(ReviewRequest $request)
    {


        $data = $request->validated();

        $review = Review::create($data);

        return $review;

    }


    public function show(Review $review)
    {
        return $review;
    }

    public function update(ReviewRequest $request, Review $review)
    {

        if (!$review) {
            return response()->json(['message' => ' não encontrado'], 404);
        }
        $review->product_id = $request->product_id;
        $review->customer_id = $request->customer_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        $review->save();

        return $review;

    }

    public function destroy(Review $review)
    {
        if (!$review) {
            return response()->json(['message' => 'não encontrado'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'comentario excluida'], 200);
    }
}
