<?php

namespace AvoRed\Review\Http\Controllers;

use AvoRed\Review\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use AvoRed\Review\Repository\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function store(ReviewRequest $request) {

        if(Auth::check()) {
            $request->merge(['user_id' => Auth::user()->id]);
        }

        $this->review->createReview($request->all());

        return redirect()->back()->with('notificationText','Product Review Store Successfully !!');
    }
}
