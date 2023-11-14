<?php

namespace App\Providers;

use App\Models\Owner;
use App\Nova\Brand;
use App\Nova\Phone;
use App\Nova\Stock;
use App\Nova\User;
use App\Nova\Variant;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();
//
//        Nova::initialPath("/resources/phones");
//
//        Nova::mainMenu(fn($request) => [
//            MenuSection::make("Phones", [
//                MenuItem::resource(Owner::class),
//                MenuItem::resource(Phone::class),
//                MenuItem::resource(Brand::class),
//                MenuItem::resource(Variant::class),
//            ])->collapsable()
//                ->icon("device-tablet"),
//
//            MenuSection::make("Stocks", [
//                MenuItem::resource(Stock::class),
//            ])->collapsable()
//                ->icon("cube"),
//
//            MenuSection::make("Settings", [
//                MenuItem::resource(User::class),
//            ])->collapsable()
//                ->icon("cog"),
//        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
