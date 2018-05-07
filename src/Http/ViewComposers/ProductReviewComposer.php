<?php
namespace AvoRed\Review\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Review\Models\Database\ProductReview;

class ProductReviewComposer {


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $productId  = $view->offsetGet('product')->id;
        $reviews    = ProductReview::whereProductId($productId)->get();

        $view->with('productReviews', $reviews);
    }

}