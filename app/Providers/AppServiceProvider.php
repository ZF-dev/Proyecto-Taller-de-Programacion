<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CarritoItem;

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
        // Este composer se aplica a todas las vistas (*)
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $items = CarritoItem::where('user_id', auth()->id())
                                ->with('moto')
                                ->get();

                $total = $items->sum(fn ($item) => $item->precio * $item->cantidad);

                // Aquí inyectas las variables en todas las vistas
                $view->with('carritoSidebar', $items)
                     ->with('totalCarrito', $total);
            } else {
                // Si no hay usuario logueado, pasas valores vacíos
                $view->with('carritoSidebar', collect())
                     ->with('totalCarrito', 0);
            }
        });
    }
}
