<?php

namespace App\Service;

use App\Data\EditEmployeeDTO;
use App\Data\EmployeeDTO;
use App\Repository\EmployeeRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;

class EmployeeService implements EmployeeServiceInterface
{
    /**
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(EmployeeRepositoryInterface $employeeRepository,
                                EncryptionServiceInterface $encryptionService)
    {
        $this->employeeRepository = $employeeRepository;
        $this->encryptionService = $encryptionService;
    }

    /**
     * @param EmployeeDTO $employee
     * * @param  $confirmPassword
     * @return bool
     * @throws \Exception
     */
    public function register(EmployeeDTO $employee, $confirmPassword): bool
    {
        if($employee->getPassword() !== $confirmPassword){
            throw new \Exception("The passwords do not match!");
        }


        $this->encryptPassword($employee);
        return $this->employeeRepository->insert($employee);
    }

    /**
     * @param string $username
     * @param string $password
     * @return EmployeeDTO|null
     * @throws \Exception
     */
    public function login(string  $username, string $password): ?EmployeeDTO
    {
        $userFromDB = $this->employeeRepository->findOneByUsername( $username);

        if(null === $userFromDB){
            throw new \Exception("
            Грешно име или парола!");
        }
        if($password != $userFromDB->getPassword()){
            throw new \Exception("Грешно име или парола!");
        }
        return $userFromDB;
    }

    public function currentUser(): ?EmployeeDTO
    {
        if(!$_SESSION['id']){
            return null;
        }
        return $this->employeeRepository->findOneById(intval($_SESSION['id']));
    }

    public function isLogged(): bool
    {
        if(!$this->currentUser()){
            return false;
        }
        return true;
    }

    /**
     * @return \Generator|EmployeeDTO[]
     */
    public function getAll(): \Generator
    {
       return $this->employeeRepository->findAll();
    }

    /**
     * @param int $id
     * @return EmployeeDTO
     */
    public function getOne(int $id): EmployeeDTO
    {
        return $this->employeeRepository->findOneById($id);;
    }

    /**
     * @param EmployeeDTO $employeeDTO
     * @throws \Exception
     */
    private function encryptPassword(EmployeeDTO $employeeDTO): void
    {
        $plainPassword = $employeeDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $employeeDTO->setPassword($passwordHash);
    }


    /**
     * @param EditEmployeeDTO $employee
     * * @param  $confirmPassword
     * @return void
     * @throws \Exception
     */
    public function edit(EditEmployeeDTO $employee, $confirmPassword)
    {
        if($employee->getPassword() !== $confirmPassword){
            throw new \Exception("Името или паролата са грешни!");
        }
        return $this->employeeRepository->edit($employee);
    }
}