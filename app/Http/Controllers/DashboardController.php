<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Moto;
use App\Models\Ventas;
use App\Models\Notificacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $usuariosOnline = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::now()->subMinutes(5)->timestamp)
            ->count();

        $totalUsuarios = User::count();

        $totalCompradores = User::where('role', 'buyer')->count(); 

        


        $totalMotos = Moto::count();
        $stockTotal = Moto::sum('stock');
        // $valorInventario = Moto::all()->sum(fn($m) => $m->precio * $m->stock);
        $valorInventario = DB::table('motos')->sum(DB::raw('precio * stock'));



        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        $ventasMes = Venta::whereBetween('created_at', [$inicioMes, $finMes])->sum('total');
        $inicioTresMesesAtras = Carbon::now()->subMonths(3)->startOfMonth();
        $finMesPasado = Carbon::now()->subMonths(1)->endOfMonth();
        $totalTresMeses = Venta::whereBetween('created_at', [$inicioTresMesesAtras, $finMesPasado])->sum('total');
        $metaAutomatica = $totalTresMeses / 3;
        $balanceMes = $ventasMes - $metaAutomatica;
        $ventasAnio = Ventas::whereYear('created_at', $anioActual)->sum('total');




        $motoEstrellaId = Ventas::select('moto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->groupBy('moto_id')
            ->orderByDesc('total_vendido')
            ->first();

        $motoEstrella = $motoEstrellaId ? Moto::find($motoEstrellaId->moto_id) : null;
        $unidadesEstrella = $motoEstrellaId ? $motoEstrellaId->total_vendido : 0;


        

        return view('dashboard', compact(
            'usuariosOnline', 'totalUsuarios', 'totalCompradores',
            'totalMotos', 'stockTotal', 'valorInventario',
            'ventasMes', 'ventasAnio', 'balancemes', 'metaAutomatica',
            'motoEstrella', 'unidadesEstrella',
        ));
    }
}
