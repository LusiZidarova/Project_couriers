<?php

namespace App\Repository;

use App\Data\EditEmployeeDTO;
use App\Data\EmployeeDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;

class EmployeeRepository extends DatabaseAbstract implements EmployeeRepositoryInterface
{
    public function __construct(DatabaseInterface $database,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($database, $dataBinder);
    }

    public function insert(EmployeeDTO $employeeDTO): bool
    {
        $this->db->query(
            "INSERT INTO employees(user_number,username, password,full_name,phone,office_id)
                  VALUES(?,?,?,?,?,?)
             "
        )->execute([
            $employeeDTO->getUserNumber(),
            $employeeDTO->getUsername(),
            $employeeDTO->getPassword(),
            $employeeDTO->getFullName(),
            $employeeDTO->getPhone(),
            $employeeDTO->getOfficeId()
        ]);

        return true;
    }
    public function edit(EditEmployeeDTO $employeeDTO){
        $this->db->query(
            "UPDATE employees SET
                     user_number = ?,
                     username =?,
                     password = ?,
                     full_name =?,
                     phone =?,
                     office_id=?
            WHERE id = ?"
        )->execute([
            $employeeDTO->getUserNumber(),
            $employeeDTO ->getUsername(),
            $employeeDTO->getPassword(),
            $employeeDTO->getFullName(),
            $employeeDTO->getPhone(),
            $employeeDTO->getOfficeId(),
            $employeeDTO->getId()
        ]);

    }

    public function findOneByUsername(string  $username): ?EmployeeDTO
    {
        return $this->db->query(
            "SELECT id, 
                    user_number,
                    username,
                    password,
                    full_name,
                    phone
                  FROM employees
                  WHERE username = ?
             "
        )->execute([$username])
            ->fetch(EmployeeDTO::class)
            ->current();
    }

    public function findOneById(int $id): ?EmployeeDTO
    {
        return $this->db->query(
            "SELECT e.id,
                    e.user_number as userNumber,
                    e.username,
                    e.password,
                    e.full_name as fullName,
                    e.phone,
                    e.office_id as officeId,
                    o.office_name as officeName
                  FROM employees  e
                      JOIN offices o on e.office_id = o.id
                  WHERE e.id = ?
             "
        )->execute([$id])
            ->fetch(EmployeeDTO::class)
            ->current();
    }

    /**
     * @return \Generator|EmployeeDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                  SELECT  
                         e.id,
                    e.user_number as userNumber, 
                    e.username,
                    e.password,
                    e.full_name as fullName,
                    e.phone,
                    e.office_id as officeId,
                    o.office_name as officeName
                  FROM employees e
                  JOIN offices o on e.office_id = o.id
                  ORDER BY e.full_name
            "
        )->execute()
            ->fetch(EmployeeDTO::class);
    }
}