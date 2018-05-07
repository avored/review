<?php

namespace AvoRed\Review\Http\Controllers;

use AvoRed\Review\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use AvoRed\Review\Models\Database\ProductReview;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request) {

        if(Auth::check()) {
            $request->merge(['user_id' => Auth::user()->id]);
        }

        ProductReview::createReview($request->all());

        return redirect()->back()->with('notificationText','Product Review Store Successfully !!');
    }
}
