<?php

namespace AvoRed\Review\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Review\Models\Database\ProductReview;

class Review extends AbstractRepository
{
    public function model()
    {
        return new ProductReview();
    }

    /**
     * Create a Product Review
     *
     * @param array $data
     * @return \AvoRed\Review\Models\Database\ProductReview $productReview
     */
    public function createReview($data): ProductReview {
        return ProductReview::create($data);
    }

    /**
     * Find a Product Review
     *
     * @param integer $id
     * @return \AvoRed\Review\Models\Database\ProductReview $productReview
     */
    public function findReviewById($id):ProductReview {

        return ProductReview::find($id);
    }

    /**
     * Get ALL Reviews By Product Id
     *
     * @param integer $id
     * @return \AvoRed\Review\Models\Database\ProductReview $productReview
     */
    public function getReviewsByProductId($id) {

        return ProductReview::whereProductId($id)->get();
    }
}
