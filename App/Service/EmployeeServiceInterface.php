<?php

namespace App\Service;

use App\Data\EditEmployeeDTO;
use App\Data\EmployeeDTO;

interface EmployeeServiceInterface
{
    public function register(EmployeeDTO $employee, string $confirmPassword) : bool;
    public function login(string  $username, string $password) : ?EmployeeDTO;
    public function edit(EditEmployeeDTO $employeeDTO, $confirmPassword);
    public function currentUser() : ?EmployeeDTO;
    public function isLogged() : bool;
    public function getOne(int $id): EmployeeDTO;

    /**
     * @return EmployeeDTO[]|\Generator
     */
    public function getAll() : \Generator;

}