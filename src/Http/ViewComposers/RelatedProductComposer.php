<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Framework\Repository\Product;
use AvoRed\Related\DataGrid\RelatedProduct;
use AvoRed\Related\Repository\Related;
use Illuminate\View\View;

class RelatedProductComposer {

    /**
     * The Product repository implementation.
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $product;

    /**
     * The Related repository implementation.
     *
     * @var \AvoRed\Related\Repository\Related
     */
    protected $related;

    /**
     * Create a new profile composer.
     *
     * @param  \AvoRed\Framework\Repository\Product  $product
     * @return void
     */
    public function __construct(Product $product, Related $related)
    {
        $this->product = $product;
        $this->related = $related;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $productId = $view->offsetGet('model')->id;
        $productModel = $this->product->model()->query();
        $relatedProductGrid = new RelatedProduct($productModel, $this->related, $productId);

        $view->with('dataGrid', $relatedProductGrid->dataGrid);
    }

}