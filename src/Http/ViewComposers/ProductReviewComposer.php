<?php
namespace AvoRed\Review\Http\ViewComposers;

use AvoRed\Review\Repository\Review;
use Illuminate\View\View;

class ProductReviewComposer {


    /**
     * The Related repository implementation.
     *
     * @var \AvoRed\Review\Repository\Review
     */
    protected $review;

    /**
     * Create a new profile composer.
     *
     * @param  \AvoRed\Review\Repository\Review $review
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->review  = $review;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $productId = $view->offsetGet('product')->id;

        $reviews = $this->review->getReviewsByProductId($productId);

        $view->with('productReviews', $reviews);
    }

}