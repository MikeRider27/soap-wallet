<?php

namespace App\Http\Controllers\Soap;

use App\Http\Controllers\Controller;
use SoapServer;
use App\Models\Cliente;
use App\Models\Compra;
use Illuminate\Support\Str;

class WalletSoapController extends Controller
{
    public function server()
    {
        $server = new SoapServer(null, [
            'uri' => 'http://localhost:9000/soap/server', // Fijo, no dinámico
        ]);
        $server->setClass(self::class); // Exponer métodos públicos
        $server->handle(); // Procesar directamente
        exit; // Importantísimo: detener el flujo de Laravel después de handle
    }

    // MÉTODO SOAP: Registrar cliente
    public function registroCliente($documento, $nombre, $email, $celular)
    {
        // Validar campos obligatorios
        if (!$documento || !$nombre || !$email || !$celular) {
            return [
                'codigo' => '99',
                'mensaje' => 'Todos los campos son requeridos',
                'data' => null
            ];
        }

        try {
            // Crear cliente usando Eloquent
            Cliente::create([
                'documento' => $documento,
                'nombre' => $nombre,
                'email' => $email,
                'celular' => $celular,
                'saldo' => 0
            ]);

            return [
                'codigo' => '00',
                'mensaje' => 'Cliente registrado exitosamente',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'codigo' => '99',
                'mensaje' => 'Error al registrar cliente: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    // MÉTODO SOAP: Recargar billetera
    public function recargarBilletera($documento, $celular, $monto)
    {
        if (!$documento || !$celular || !$monto) {
            return [
                'codigo' => '99',
                'mensaje' => 'Todos los campos son requeridos',
                'data' => null
            ];
        }

        try {
            // Buscar cliente con Eloquent
            $cliente = Cliente::where('documento', $documento)
                ->where('celular', $celular)
                ->first();

            if (!$cliente) {
                return [
                    'codigo' => '99',
                    'mensaje' => 'Cliente no encontrado',
                    'data' => null
                ];
            }

            // Actualizar saldo
            $cliente->saldo += (float) $monto;
            $cliente->save();

            return [
                'codigo' => '00',
                'mensaje' => 'Recarga exitosa',
                'data' => ['saldo' => $cliente->saldo]
            ];
        } catch (\Exception $e) {
            return [
                'codigo' => '99',
                'mensaje' => 'Error al recargar: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

  



}
