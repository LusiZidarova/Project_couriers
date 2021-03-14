<?php
namespace App\Data;


class EditEmployeeDTO extends EmployeeDTO
{
    private $offices;

    /**
     * @return mixed
     */
    public function getOffices()
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

}