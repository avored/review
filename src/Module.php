<?php

namespace AvoRed\Review;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\AdminMenu;
use AvoRed\Review\Http\ViewComposers\ProductReviewComposer;

use Illuminate\Support\Facades\View;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;

class Module extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerAdminMenu();
        $this->registerBreadCrumb();
        $this->registerViewComposer();
        $this->publishFiles();
        //$this->registerListener();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-review');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-review');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }



    /**
     * Register the Product Edit View Composer Class.
     *
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('avored-review::product.review', ProductReviewComposer::class);
    }


    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $systemMenu = AdminMenuFacade::get('system');

        $reviewMenu = new AdminMenu();
        $reviewMenu->key('review')
            ->label('Review')
            ->route('admin.review.index')
            ->icon('fas fa-leaf');

        $systemMenu->subMenu('review', $reviewMenu);
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
    public function publishFiles() {

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ],'avored-module-views');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('avored-migrations'),
        ]);
    }

}