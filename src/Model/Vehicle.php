<?php

namespace App\Model;

class Vehicle
{    
    public function __construct(
        public readonly string $licensePlate,
        public readonly string $vin,
        public readonly string $make,
        public readonly string $model,
        public readonly int $year,
        public readonly string $color,
    ) {}
}
