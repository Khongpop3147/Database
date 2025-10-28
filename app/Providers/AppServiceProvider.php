<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        \View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())
                    ->with('items')
                    ->first()
                    ?->items
                    ->sum('quantity') ?? 0;
                    
                $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                
                $view->with('cartCount', $cartCount);
                $view->with('wishlistCount', $wishlistCount);
            } else {
                $view->with('cartCount', 0);
                $view->with('wishlistCount', 0);
            }
        });
    }
}
