<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Related\Repository\Related;
use Illuminate\View\View;

class RelatedProductViewComposer {


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
    public function __construct(Related $related)
    {
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
        $view->with('related', $this->related);
    }

}