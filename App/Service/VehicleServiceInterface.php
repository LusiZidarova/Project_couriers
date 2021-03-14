<?php
namespace App\Service;

use App\Data\VehicleDTO;

interface VehicleServiceInterface
{
    public function createInsert(VehicleDTO $vehicle);

    /**
     * @return VehicleDTO []|\Generator
     */
    public function getAll(): \Generator;

    public function getOne(int $id): VehicleDTO;

}