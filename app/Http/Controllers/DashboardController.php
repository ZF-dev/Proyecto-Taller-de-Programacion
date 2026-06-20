<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Moto;
use App\Models\Venta;
use App\Models\VentaItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $anioActual = Carbon::now()->year;

        $usuariosOnline = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::now()->subMinutes(5)->timestamp)
            ->count();

        $totalUsuarios = User::count();
        $totalCompradores = Venta::whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');

        $totalMotos = Moto::count();
        $stockTotal = Moto::sum('stock');
        $valorInventario = Moto::sum(DB::raw('precio * stock'));

        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        $ventasMes = Venta::whereBetween('created_at', [$inicioMes, $finMes])->sum('total');
        
        $inicioTresMesesAtras = Carbon::now()->subMonths(3)->startOfMonth();
        $finMesPasado = Carbon::now()->subMonths(1)->endOfMonth();
        $totalTresMeses = Venta::whereBetween('created_at', [$inicioTresMesesAtras, $finMesPasado])->sum('total');
        
        $metaAutomatica = $totalTresMeses / 3;
        $balanceMes = $ventasMes - $metaAutomatica;
        $ventasAnio = Venta::whereYear('created_at', $anioActual)->sum('total');

        $motoEstrellaData = VentaItem::select('moto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->whereNotNull('venta_id') 
            ->groupBy('moto_id')
            ->orderByDesc('total_vendido')
            ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'imagen', 'precio')])
            ->first();

        $motoEstrella = null;
        if ($motoEstrellaData && $motoEstrellaData->moto) {
            $motoEstrella = $motoEstrellaData->moto;
            $motoEstrella->total_vendido = $motoEstrellaData->total_vendido; 
        }

        return view('Dashboard', compact(
            'usuariosOnline', 'totalUsuarios', 'totalCompradores',
            'totalMotos', 'stockTotal', 'valorInventario',
            'ventasMes', 'ventasAnio', 'balanceMes', 'metaAutomatica', 
            'motoEstrella'
        ));
    }
}
