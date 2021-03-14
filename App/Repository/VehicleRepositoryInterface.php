<?php
namespace App\Repository;

use App\Data\FullVehiclesDTO;
use App\Data\VehicleDTO;


interface VehicleRepositoryInterface
{
    public function addUpdate(VehicleDTO $vehicle);

    /**
     * @return VehicleDTO[]|\Generator
     */
    public function findAll(): \Generator;

    public function findOne(int $id): VehicleDTO;

    /*public function edit(VehicleDTO $vehicle);*/

}