<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
{
    $rating = $request->rating;

    $reviews = \App\Models\Review::with('user', 'book')
        ->when($rating, function ($q) use ($rating) {
            $q->where('rating', $rating);
        })
        ->latest()
        ->get();

    return view('reviews.index', compact('reviews', 'rating'));
}
}
