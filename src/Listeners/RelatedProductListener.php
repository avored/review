<?php
namespace AvoRed\Related\Listeners;

use AvoRed\Ecommerce\Events\ProductAfterSave;
use AvoRed\Related\Repository\Related;

class RelatedProductListener
{

    /**
     * Related Product Repository
     *
     * @var \AvoRed\Related\Repository\Related
     */
    protected $related;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Related $related)
    {
        $this->related = $related;
    }

    /**
     * Handle the event.
     *
     * @param  \AvoRed\Ecommerce\Events\ProductAfterSave  $event
     * @return void
     */
    public function handle(ProductAfterSave $event)
    {
        $productId          = $event->product->id;
        $relatedProducts    = $event->request->get('related');

        if(null != $relatedProducts && count($relatedProducts) > 0) {


            $this->related->model()->whereProductId($productId)->delete();

            foreach ($relatedProducts as $relatedId => $checkedValue) {

                if ($checkedValue == 1) {
                    $this->related->model()->create(['product_id' => $productId, 'related_id' => $relatedId]);
                }

            }
        }

    }
}