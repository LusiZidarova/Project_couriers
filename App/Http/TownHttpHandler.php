<?php
namespace App\Http;

use App\Data\TownDTO;
use App\Service\TownServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use App\Service\EmployeeServiceInterface;

class TownHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var TownServiceInterface
     */
    private $townService;
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;



    public function __construct(TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                TownServiceInterface $townService,
                                EmployeeServiceInterface $employeeService)
    {
        parent::__construct($template, $dataBinder);
        $this->townService = $townService;
        $this->employeeService=$employeeService;
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    public function addTown(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['add'])) {
                $this->handleAddProcess($formData);
        } else {
            $this->render("towns/add");
        }
    }

    private function handleAddProcess(array $formData)
    {
        try {
            /** @var TownDTO $dto */
            $dto = $this->dataBinder->bind($formData, TownDTO::class);
            $this->townService->create($dto);
            $this->redirect("towns.php");
        } catch (\Exception $ex) {
            $this->render("towns/add", [$ex->getMessage()]);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    public function editTown(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
           $dto = $this->getEditDTO();
            $this->render("towns/edit", $dto);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    private function handleEditProcess(array $formData)
    {
        try {
            /** @var TownDTO $dto */
            $dto = $this->dataBinder->bind($formData, TownDTO::class);
            $dto->setId($_SESSION['id']);
            $this->townService->edit($dto);
            $this->redirect("towns.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();
            $this->render("towns/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    public function allTowns()
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        $this->render('towns/towns',$this->townService->getAll());
    }

    /**
     * @return TownDTO
     * @throws \Exception
     */
    private function getEditDTO():TownDTO
    {
        $town = $this->townService->getOne($_REQUEST['id']);
        $dto = new TownDTO();
        $_SESSION['id'] = $town->getId();
        $dto->setId($town->getId());
        $dto->setName($town->getName());
        $dto->setProvince($town->getProvince());
        $dto->setMunicipality($town->getMunicipality());
        $dto->setPostcode($town->getPostcode());
        return $dto;
    }
}