<?php
namespace App\Http;

use App\Data\OfficeDTO;
use App\Data\EditOfficeDTO;
use App\Service\EmployeeServiceInterface;
use App\Service\OfficeServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use App\Service\TownServiceInterface;

class OfficeHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var TownServiceInterface
     */
    private $townService;
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
                                TownServiceInterface $townService,
                                OfficeServiceInterface $officeService,
EmployeeServiceInterface $employeeService)
    {
        parent::__construct($template, $dataBinder);
        $this->townService = $townService;
        $this->officeService=$officeService;
        $this->employeeService = $employeeService;
    }

    /**
     * @param array $formData
     * @throws \Exception
     *
     */
    public function addOffice(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['add'])) {
                $this->handleAddProcess($formData);
        } else {
            $dto=$this->townService->getAll();
            $this->render("offices/add",$dto);
        }
    }

    private function handleAddProcess(array $formData)
    {
        try {
            /** @var OfficeDTO $dto */
            $dto = $this->dataBinder->bind($formData, OfficeDTO::class);
            $town = $this->townService->getOne($formData['town_id']);
            $dto->setTownId($town->getId());
            $dto->setTownName($town->getName());

            $this->officeService->create($dto);
            $this->redirect("offices.php");
        } catch (\Exception $ex) {
            $dto = $this->townService->getAll();
            $this->render("offices/add",$dto, [$ex->getMessage()]);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    public function editOffice(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
           $dto = $this->getEditDTO();
            $this->render("offices/edit", $dto);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    private function handleEditProcess(array $formData)
    {
        try {
            /** @var OfficeDTO $dto */
            $dto = $this->dataBinder->bind($formData, OfficeDTO::class);
            $dto->setId($_SESSION['id']);
            $town = $this->townService->getOne($formData['town_id']);
            $dto->setTownName($town->getName());
            $this->officeService->edit($dto);
            $this->redirect("offices.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();
            $this->render("offices/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    public function allOffices()
    {

        $this->render('offices/offices',$this->officeService->getAll());
    }

    /**
     * @return EditOfficeDTO
     * @throws \Exception
     */
    private function getEditDTO():EditOfficeDTO
    {
        $office = $this->officeService->getOne($_REQUEST['id']);
        $dto = new EditOfficeDTO();
        $_SESSION['id'] =  $_REQUEST['id'];
        $dto->setId( $office->getId());
        $dto->setOfficeName( $office->getOfficeName());
        $dto->setManager( $office->getManager());
        $dto->setAddress( $office->getAddress());
        $dto->setPhone( $office->getPhone());
        $dto->setWorkingHours($office->getWorkingHours());
        $dto->setTownId($office->getTownId());
        $dto->setTownName($office->getTownName());
        $dto->setTowns($this->townService->getAll());
        return $dto;
    }
}