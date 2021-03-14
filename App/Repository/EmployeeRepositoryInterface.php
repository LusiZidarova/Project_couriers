<?php

namespace App\Repository;

use App\Data\EditEmployeeDTO;
use App\Data\EmployeeDTO;

interface EmployeeRepositoryInterface
{
    public function insert(EmployeeDTO $employeeDTO) : bool;
    public function edit(EditEmployeeDTO $employeeDTO);
    public function findOneByUsername(string  $username): ?EmployeeDTO;
    public function findOneById(int $id) : ?EmployeeDTO;

    /**
     * @return \Generator|EmployeeDTO[]
     */
    public function findAll() : \Generator;
}