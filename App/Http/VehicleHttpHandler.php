<?php
namespace App\Http;

use App\Data\FullVehiclesDTO;
use App\Service\VehicleServiceInterface;
use App\Service\OfficeServiceInterface;
use App\Service\EmployeeServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use App\Data\VehicleDTO;

class VehicleHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var VehicleServiceInterface
     */
    private $vehicleService;
    /**
     * @var OfficeServiceInterface
     */
    private $officeService;
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;



    public function __construct(TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                VehicleServiceInterface $vehicleService,
                                OfficeServiceInterface $officeService,
                                EmployeeServiceInterface $employeeService)
    {
        parent::__construct($template, $dataBinder);
        $this->vehicleService = $vehicleService;
        $this->officeService=$officeService;
        $this->employeeService =$employeeService;
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    public function addVehicle(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['add'])) {
                $this->handleAddProcess($formData);
        } else {
            $dtoOffice=$this->officeService->getAll();
            $dtoUser = $this->employeeService->getAll();
            $dto['offices'] = $dtoOffice;
            $dto['employees']   = $dtoUser;

            $this->render("vehicles/add",$dto);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    private function handleAddProcess(array $formData)
    {
        try {
            /** @var VehicleDTO $dto */
            $dto = $this->dataBinder->bind($formData, VehicleDTO::class);

            $office = $this->officeService->getOne($formData['office_id']);

            $dto->setOfficeId($office->getId());
            $dto->setOfficeName($office->getOfficeName());

            $employee = $this->employeeService->getOne($formData['employee_id']);

            $dto->setEmployeeId($employee->getId());
            $dto->setEmployeeName($employee->getFullName());

            $this->vehicleService->createInsert($dto);
            $this->redirect("vehicles.php");
        } catch (\Exception $ex) {

            $dto->$this->officeService->getAll();
            $dto->$this->employeeService->getAll();

            $this->render("vehicles/add",$dto, [$ex->getMessage()]);
        }
    }
    /**
     * @param array $formData
     * @throws \Exception
     */
    public function editVehicle(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
           $dto = $this->getEditDTO();
            $this->render("vehicles/edit", $dto);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    private function handleEditProcess(array $formData)
    {
        try {
            /** @var VehicleDTO $dto */
            $dto = $this->dataBinder->bind($formData, VehicleDTO::class);
            $dto->setId($_SESSION['id']);

            $office = $this->officeService->getOne($formData['office_id']);
            $dto->setOfficeId($office->getId());
            $dto->setOfficeName($office->getOfficeName());

            $employee = $this->employeeService->getOne($formData['employee_id']);
            $dto->setEmployeeId($employee->getId());
            $dto->setEmployeeName($employee->getFullName());

            $this->vehicleService->createInsert($dto);
            $this->redirect("vehicles.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();
            $this->render("vehicles/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    public function allVehicles()
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        $this->render('vehicles/vehicles',$this->vehicleService->getAll());
    }

    /**
     * @return FullVehiclesDTO
     * @throws \Exception
     */
    private function getEditDTO():FullVehiclesDTO
    {
        $vehicle = $this->vehicleService->getOne($_REQUEST['id']);
        $dto = new FullVehiclesDTO();
       $_SESSION['id'] =  $_REQUEST['id'];

        $dto->setId( $vehicle->getId());
        $dto->setBrand($vehicle->getBrand());
        $dto->setModel($vehicle->getModel());
        $dto->setRegNumber($vehicle->getRegNumber());
        $dto->setFuelConsumption($vehicle->getFuelConsumption());
        $dto->setOfficeId($vehicle->getOfficeId());
        $dto->setOfficeName($vehicle->getOfficeName());
        $dto->setOffices($this->officeService->getAll());
        $dto->setEmployeeId($vehicle->getEmployeeId());
        $dto->setEmployeeName($vehicle->getEmployeeName());
        $dto->setUsers($this->employeeService->getAll());
        return $dto;
    }
}