<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PagosController extends Controller
{
    public function index()
    {
        // Obtener todos los pagos y devolverlos como JSON
        $pagos = Pago::all();
        return response()->json($pagos);
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'id_socio' => 'required|exists:socios,id_socio',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'adeudo' => 'required|numeric',
            'descripcion' => 'required|string',
        ]);

        // Creación del pago
        $pago = new Pago();
        $pago->id_socio = $request->id_socio;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->monto = $request->monto;
        $pago->adeudo = $request->adeudo;
        $pago->descripcion = $request->descripcion;
        $pago->save();

        // Responder con el pago creado en formato JSON
        return response()->json($pago, 201);  // 201 para indicar que el recurso ha sido creado
    }

    public function edit($id)
    {
        // Obtener el pago a editar
        $pago = Pago::findOrFail($id);
        return response()->json($pago);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'id_socio' => 'required|exists:users,id',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'adeudo' => 'required|numeric',
            'descripcion' => 'required|string',
        ]);

        // Actualización del pago
        $pago = Pago::findOrFail($id);
        $pago->id_socio = $request->id_socio;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->monto = $request->monto;
        $pago->adeudo = $request->adeudo;
        $pago->descripcion = $request->descripcion;
        $pago->save();

        // Responder con el pago actualizado en formato JSON
        return response()->json($pago);
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        // Responder con un mensaje de éxito
        return response()->json(['message' => 'Pago eliminado exitosamente']);
    }

    public function show($id)
    {
        $pago = Pago::findOrFail($id);
        return response()->json($pago);
    }

    public function download($id)
    {
        $pago = Pago::findOrFail($id);
        $pdf = PDF::loadView('pagos.print', compact('pago'));

        // Devolver el PDF como respuesta
        return response()->json([
            'message' => 'PDF generado',
            'file' => base64_encode($pdf->output())  // Se convierte el PDF en base64 para enviarlo por JSON
        ]);
    }

    
}
