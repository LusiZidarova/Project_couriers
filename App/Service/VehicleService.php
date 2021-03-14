<?php
namespace App\Service;

use App\Data\FullVehiclesDTO;
use App\Data\VehicleDTO;
use App\Repository\VehicleRepositoryInterface;

class VehicleService implements VehicleServiceInterface
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;
    /**
     * VehicleService constructor.
     * @param VehicleRepositoryInterface $vehicleRepository
     * @param  EmployeeServiceInterface $employeeService
     */
    public function __construct(VehicleRepositoryInterface $vehicleRepository, EmployeeServiceInterface $employeeService)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->employeeService = $employeeService;
    }

    /**
     * @param VehicleDTO $vehicle
     * @return mixed
     * @throws \Exception
     */
    public function createInsert(VehicleDTO $vehicle)
    {
        return $this->vehicleRepository->addUpdate($vehicle);
    }

    /**
     * @return FullVehiclesDTO[]|\Generator
     */
    public function getAll(): \Generator
    {
        return $this->vehicleRepository->findAll();
    }

    /**
     * @param int $id
     * @return VehicleDTO
     */
    public function getOne(int $id): VehicleDTO
    {
        return $this->vehicleRepository->findOne($id);;
    }
}