<?php

namespace App\Data;
use App\Data\VehicleDTO;


class FullVehiclesDTO extends VehicleDTO
{

    private $offices;

    private $users;

    /**
     * @return OfficeDTO[]|\Generator
     */
    public function getOffices():\Generator
    {
        return $this->offices;
    }

    /**
     * @param mixed $offices
     */
    public function setOffices($offices): void
    {
        $this->offices = $offices;
    }


    /**
     * @return EmployeeDTO[]|\Generator
     */
    public function getUsers():\Generator
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }








}