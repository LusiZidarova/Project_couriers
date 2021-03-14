<?php
namespace App\Service;

use App\Data\OfficeDTO;
use App\Data\FullOfficesDTO;
use App\Repository\OfficeRepositoryInterface;

class OfficeService implements OfficeServiceInterface
{
    /**
     * @var OfficeRepositoryInterface
     */
    private $officeRepository;
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;
    /**
     * OfficeService constructor.
     * @param OfficeRepositoryInterface $officeRepository
     * @param  EmployeeServiceInterface $employeeService
     */
    public function __construct(OfficeRepositoryInterface $officeRepository, EmployeeServiceInterface $employeeService)
    {
        $this->officeRepository = $officeRepository;
        $this->employeeService = $employeeService;
    }

    /**
     * @param OfficeDTO $office
     * @return mixed
     * @throws \Exception
     */
    public function create(OfficeDTO $office)
    {
        return $this->officeRepository->add($office);
    }

    /**
     * @return FullOfficesDTO[]|\Generator
     */
    public function getAll(): \Generator
    {
        return $this->officeRepository->findAll();
    }

    /**
     * @param OfficeDTO $office
     * @param int $id
     * @throws \Exception
     */
    public function edit(OfficeDTO $office)
    {
        $this->officeRepository->edit($office);
    }

    /**
     * @param int $id
     * @return OfficeDTO
     */
    public function getOne(int $id): OfficeDTO
    {
        return $this->officeRepository->findOne($id);;
    }


}