<?php
namespace App\Service;

use App\Data\FullTownsDTO;
use App\Data\TownDTO;
use App\Repository\TownRepositoryInterface;

class TownService implements TownServiceInterface
{
    /**
     * @var TownRepositoryInterface
     */
    private $townRepository;
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;
    /**
     * TownService constructor.
     * @param TownRepositoryInterface $townRepository
     * @param  EmployeeServiceInterface $employeeService
     */
    public function __construct(TownRepositoryInterface $townRepository, EmployeeServiceInterface $employeeService)
    {
        $this->townRepository = $townRepository;
        $this->employeeService = $employeeService;
    }

    /**
     * @param TownDTO $town
     * @return mixed
     * @throws \Exception
     */
    public function create(TownDTO $town)
    {
        return $this->townRepository->add($town);
    }

    /**
     * @return FullTownsDTO[]|\Generator
     */
    public function getAll(): \Generator
    {
        return $this->townRepository->findAll();
    }

    /**
     * @param TownDTO $town
     * @param int $id
     * @throws \Exception
     */
    public function edit(TownDTO $town)
    {
        $this->townRepository->edit($town);
    }

      /**
     * @param int $id
     * @return TownDTO
     */
    public function getOne(int $id): TownDTO
    {
        return $this->townRepository->findOne($id);;
    }


}