<?php
namespace App\Repository;

use App\Data\VehicleDTO;
use Generator;

class VehicleRepository extends DatabaseAbstract implements VehicleRepositoryInterface
{
    public function addUpdate(VehicleDTO $vehicle)
    {
        $this->db->query("CALL insert_Or_Update_Vehicle(?, ?, ?, ?, ?, ?, ?);")
            ->execute([
                $vehicle->getId(),
                $vehicle->getBrand(),
                $vehicle->getModel(),
                $vehicle->getRegNumber(),
                $vehicle->getFuelConsumption(),
                $vehicle->getOfficeId(),
                $vehicle->getEmployeeId()
            ]);
    }

    /**
     * @return VehicleDTO[]|Generator
     */
    public function findAll(): Generator
    {
        return $this->db->query(
            "SELECT
                    v.id,
                    v.brand,
                    v.model,
                    v.reg_number as regNumber,
                    v.fuel_consumption as fuelConsumption,
                    v.office_id as officeId,
                    o.office_name as officeName,
                    v.employee_id as employeeId,
                    e.full_name as employeeName
                   FROM
                    vehicles v
                    JOIN offices o on v.office_id = o.id
                    JOIN employees e on v.employee_id = e.id
                    ORDER BY o.office_name 
            "
        )->execute()->fetch(VehicleDTO::class);
    }

    public function findOne(int $id): VehicleDTO
    {
        return $this->db->query(
            "SELECT
                   v.id,
                   v.brand,
                   v.model,
                   v.reg_number as regNumber,
                   v.fuel_consumption as fuelConsumption,
                   v.office_id as officeId,
                   o.office_name as officeName,
                   v.employee_id as employeeId,
                   e.full_name as employeeName
                   FROM
                    vehicles v
                    JOIN offices o on v.office_id = o.id
                    JOIN employees e on v.employee_id = e.id
                   
                    WHERE v.id = ?"
        )->execute([$id])->fetchOne(VehicleDTO::class);
    }
}