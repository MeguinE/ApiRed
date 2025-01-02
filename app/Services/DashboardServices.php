<?php
namespace App\Services;

use App\Models\Pago;
use App\Models\Eventos;
use App\Models\User;
use Carbon\Carbon;

class DashboardServices
{
    public function obtenerDashboardData()
    {
        $totalSocios = User::count();
        $nuevosSocios = User::where('fecha_registro', '>=', now()->subYear())->count();
        $ingresosMenbresia = Pago::sum('monto');

        $anio = now()->year;
        $ingresosMensuales = [];
        $labels = [];

        for ($mes = 1; $mes <= 12; $mes++) {
            $fechaInicio = Carbon::create($anio, $mes, 1)->startOfMonth();
            $fechaFin = Carbon::create($anio, $mes, 1)->endOfMonth();

            $ingresoMes = Pago::whereBetween('fecha_pago', [$fechaInicio, $fechaFin])->sum('monto');

            $ingresosMensuales[] = $ingresoMes ?? 0;
            $labels[] = Carbon::create($anio, $mes, 1)->format('F');
        }

        // Filtrado y combinación de datos
        $datosGrafico = array_filter(array_combine($labels, $ingresosMensuales));
        $labelsFiltrados = array_keys($datosGrafico);
        $ingresosMensualesFiltrados = array_values($datosGrafico);

        $actividadesRecientes = Eventos::orderBy('fecha_inicio', 'desc')->take(5)->get(['nombre_evento', 'fecha_inicio']);

        $renovacionesPendientes = User::where('estado', 'activo')
            ->whereHas('pagos', function ($query) {
                $query->where('adeudo', '>', 0);
            })
            ->get(['nombre', 'fecha_registro', 'id_socio']); // Añadir ID para mejor identificación

        return [
            'totalSocios' => $totalSocios,
            'nuevosSocios' => $nuevosSocios,
            'ingresosMembresias' => $ingresosMenbresia,
            'labels' => $labelsFiltrados,
            'ingresosMensuales' => $ingresosMensualesFiltrados,
            'actividadesRecientes' => $actividadesRecientes,
            'renovacionesPendientes' => $renovacionesPendientes,
        ];
    }
}
