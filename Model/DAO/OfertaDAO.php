<?php
require_once __DIR__ . '/../../database/database.php';
class OfertaDAO
{
    // Regla fija (simple)
    private const CANTIDAD_MINIMA = 3;
    private const PORCENTAJE = 0.10; // 10%

    /**
     * Devuelve la oferta activa (muy simple)
     */
    public static function obtenerOfertaActiva(): array
    {
        return [
            'cantidad_minima' => self::CANTIDAD_MINIMA,
            'porcentaje' => self::PORCENTAJE
        ];
    }

    /**
     * Calcula el descuento según el carrito
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