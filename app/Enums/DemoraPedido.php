<?php 
namespace App\Enums;

enum DemoraPedido: int
{
    case UN_DIA = 1;
    case DOS_DIAS = 2;
    case TRES_DIAS = 3;

    public static function desdeProbabilidad(float $r): self
    {
        return match (true) {
            $r < 0.4  => self::UN_DIA,
            $r < 0.9  => self::DOS_DIAS,
            default   => self::TRES_DIAS,
        };
    }
}
