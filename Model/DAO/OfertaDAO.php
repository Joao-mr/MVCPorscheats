<?php
require_once __DIR__ . '/../../database/database.php';

class OfertaDAO
{
    // Cantidad mínima de productos para activar la oferta.
    private const CANTIDAD_MINIMA = 3;

    // Porcentaje fijo aplicado cuando se cumple la cantidad mínima.
    private const PORCENTAJE = 0.10;

    /**
     * Devuelve la configuración activa de la oferta.
     */
    public static function obtenerOfertaActiva(): array
    {
        return [
            'cantidad_minima' => self::CANTIDAD_MINIMA,
            'porcentaje' => self::PORCENTAJE
        ];
    }

    /**
     * Calcula si el carrito recibe descuento y devuelve totales.
     */
    public static function calcularDescuento(int $cantidadProductos, float $subtotal): array
    {
        if ($cantidadProductos < self::CANTIDAD_MINIMA) {
            return [
                'aplica' => false,
                'descuento' => 0,
                'total' => round($subtotal, 2)
            ];
        }

        $descuento = round($subtotal * self::PORCENTAJE, 2);

        return [
            'aplica' => true,
            'descuento' => $descuento,
            'total' => round($subtotal - $descuento, 2)
        ];
    }
}