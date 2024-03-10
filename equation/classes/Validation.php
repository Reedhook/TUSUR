<?php
declare(strict_types=1);
class Validation
{
    /**
     * @param float $a
     * @return void
     * @throws Exception
     */
    public function isQuadraticEquation(float $a): void
    {
         ($a != 0)?:throw new Exception('Уравнение не является квадратным');
    }
}