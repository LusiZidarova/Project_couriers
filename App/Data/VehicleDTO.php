<?php

namespace App\Data;


class VehicleDTO
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $model;
    /**
     * @var string
     */
    private $regNumber;
    /**
     * @var float
     */
    private $fuelConsumption;

    /**
     * @var int
     */
    private $officeId;

    /**
     * @var string
     */

    private $officeName;
    /**
     *
    * @var int
     */
    private $employeeId;

    /**
     * @var string
     */
    private $employeeName;





    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getBrand():string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setBrand(string $brand): VehicleDTO
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setModel(string $model): VehicleDTO
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegNumber(): string
    {
        return $this->regNumber;
    }

    /**
     * @param string $regNumber
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setRegNumber(string $regNumber): VehicleDTO
    {
        $this->regNumber = $regNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getFuelConsumption()
    {
        return $this->fuelConsumption;
    }

    /**
     * @param float $fuelConsumption
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setFuelConsumption(float $fuelConsumption): VehicleDTO
    {
        $this->fuelConsumption = $fuelConsumption;
        return $this;
    }

    /**
     * @return int
     */
    public function getOfficeId(): int
    {
        return $this->officeId;
    }

    /**
     * @param int $officeId
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setOfficeId(int $officeId): void
    {
        $this->officeId = $officeId;
    }

    /**
     * @return string
     */
    public function getOfficeName(): string
    {
        return $this->officeName;
    }

    /**
     * @param string $officeName
     */
    public function setOfficeName(string $officeName): void
    {
        $this->officeName = $officeName;
    }

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    /**
     * @param int $employeeId
     * @return VehicleDTO
     * @throws \Exception
     */
    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;

    }

    /**
     * @return string
     */
    public function getEmployeeName(): string
    {
        return $this->employeeName;
    }

    /**
     * @param string $employeeName
     *  @return VehicleDTO
     * @throws \Exception
     */
    public function setEmployeeName(string $employeeName): void
    {
        $this->employeeName = $employeeName;

    }



}