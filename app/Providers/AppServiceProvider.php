<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\VentaItem; // Tu nuevo modelo unificado

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
        View::composer('layout.esqueleto', function ($view) {
            if (auth()->check()) {
                $userId = auth()->id();
                
                // 🔒 CADA USUARIO VE SU PROPIO CARRITO: Filtramos por su ID y donde venta_id sea NULL
                $items = VentaItem::where('user_id', $userId)
                                ->whereNull('venta_id')
                                ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'imagen')])
                                ->get();

                $total = $items->sum(fn ($item) => $item->precio_unitario * $item->cantidad);
                $conteo = $items->sum('cantidad');

                $view->with([
                    'carritoSidebar' => $items,
                    'totalCarrito'   => $total,
                    'conteoCarrito'  => $conteo
                ]);
            } else {
                $view->with([
                    'carritoSidebar' => collect(),
                    'totalCarrito'   => 0,
                    'conteoCarrito'  => 0
                ]);
            }
        });
    }
}
