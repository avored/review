<?php

namespace AvoRed\Review\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AvoRed\Review\DataGrid\ProductReview;
use AvoRed\Review\Models\Database\ProductReview as Model;

class ReviewController extends Controller
{

    public function index() {

        $bannerGrid = new ProductReview(Model::query());

        return view('avored-review::admin.review.index')->with('dataGrid', $bannerGrid->dataGrid);
    }


    public function approve($id) {

        $review = Model::find($id);
        $review->update(['status' => 'APPROVED']);

        return redirect()->route('admin.review.index');
    }

}
