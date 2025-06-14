<?php

namespace App\Enums;

enum TestSemilla: string
{
    case Pendiente = 'pendiente';
    case Aprobado = 'aprobado';
    case Rechazado = 'rechazado';
}
// Enum para representar el estado de la prueba de una semilla
// Pendiente: La semilla aún no ha sido probada.
// Aprobado: La semilla ha pasado la prueba de Chi Cuadrado.
// Rechazado: La semilla no ha pasado la prueba de Chi Cuadrado.