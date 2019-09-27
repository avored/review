<?php

namespace AvoRed\Review;

use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;
use AvoRed\Review\Database\Repository\ProductReviewRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use AvoRed\Review\Http\ViewComposers\ProductReviewComposer;

class Module extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerAdminMenu();
        // $this->registerBreadCrumb();
        // $this->registerViewComposer();
        // $this->publishFiles();
        //$this->registerListener();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductReviewModelInterface::class, ProductReviewRepository::class);
    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'a-review');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'a-review');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Product Edit View Composer Class.
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('a-review::product.review', ProductReviewComposer::class);
    }

    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        // $shopMenu = Menu::get('shop');

        // $reviewMenu = new AdminMenu();
        // $reviewMenu->key('review')
        //     ->label('Review')
        //     ->route('admin.review.index')
        //     ->icon('fas fa-bullhorn');

        // $shopMenu->subMenu('review', $reviewMenu);
    }

    /**
     * Register the Admin Breadcrumb.
     *
     * @return void
     */
    protected function registerBreadCrumb()
    {
        BreadcrumbFacade::make('admin.review.index', function ($breadcrumbs) {
            $breadcrumbs->label('Review')
                ->parent('admin.dashboard');
        });
    }

    /**
     * Publish files paths for this avo red module.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes(
            [ __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')],
            'avored-module-views'
        );

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('avored-migrations'),
        ]);
    }
}
