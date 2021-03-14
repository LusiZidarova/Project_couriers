<?php

namespace App\Http;

use App\Data\EditEmployeeDTO;
use App\Data\EmployeeDTO;
use App\Service\EmployeeServiceInterface;
use App\Service\OfficeServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use App\Repository\EmployeeRepositoryInterface;

class EmployeeHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var EmployeeServiceInterface
     */
    private $employeeService;
    /**
    * @var EmployeeRepositoryInterface
    */
    private  $employeeRepository;
    /**
     * @var OfficeServiceInterface
     */
    private  $officeService;

    public function __construct(
        TemplateInterface $template,
        DataBinderInterface $dataBinder,
        EmployeeServiceInterface $employeeService,
        EmployeeRepositoryInterface $employeeRepository,
        OfficeServiceInterface $officeService)
    {
        parent::__construct($template, $dataBinder);
        $this->employeeService = $employeeService;
        $this->employeeRepository =$employeeRepository;
        $this->officeService = $officeService;
    }

    public function index()
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        $this->render("home/index");
    }

    public function view(array $queryData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        $currentUser = $this->employeeService->currentUser();
        $this->render('employees/view',$currentUser);
    }

    public function login(array $formData = [])
    {
        $username= "";
        if (isset($formData['login'])) {
            $this->handleLoginProcess($formData);
        } else {
            if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
            }
            $this->render("employees/login",
                $username === "" ? "" :  $username);
        }
    }

    public function AddEmployee(array $formData = [])
    {
        if (isset($formData['register'])) {
            $this->handleAddProcess($formData);
        } else {
            //jsonencode
            /*$office_arr["recordsOffice"]=array();
            array_push($office_arr["recordsOffice"],$this->officeService->getAll());

            echo json_encode($office_arr);*/

            $this->render("employees/add");
        }
    }

    private function handleAddProcess($formData)
    {
        try {
            /** @var EmployeeDTO $user */
            $user = $this->dataBinder->bind($formData, EmployeeDTO::class);

            $this->employeeService->register($user, $formData['confirm_password']);
            $this->redirect("login.php");
        } catch (\Exception $ex) {
            //jsonencode
            $office_arr["recordsOffice"]=array();
            array_push($office_arr["recordsOffice"],$this->officeService->getAll());

            echo json_encode($office_arr);

            $this->render("employees/add", null,
                [$ex->getMessage()]);
        }
    }

    private function handleLoginProcess($formData)
    {
        try {
            $user = $this->employeeService->login($formData['username'], $formData['password']);

            if (null !== $user) {
                $_SESSION['id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $this->redirect("view.php");
            }
        } catch (\Exception $ex) {
            $this->render("employees/login", null,
                [$ex->getMessage()]);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    public function editEmployee(array $formData = [])
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
            $dto = $this->getEditDTO();
            $this->render("employees/edit", $dto);
        }
    }

    /**
     * @param array $formData
     * @throws \Exception
     */
    private function handleEditProcess(array $formData)
    {
        try {
            /** @var EditEmployeeDTO $dto */
            $dto = $this->dataBinder->bind($formData, EditEmployeeDTO::class);
            $dto->setId($_GET['id']);
            $this->employeeService->edit($dto,$formData['confirm_password']);
            $_SESSION['username'] = $dto->getUsername();
            $this->redirect("employees.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();
            $this->render("employees/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    /**
     * @return EditEmployeeDTO
     * @throws \Exception
     */
    private function getEditDTO(): EditEmployeeDTO
    {
        $employee = $this->employeeService->getOne($_GET['id']);
        $dto = new EditEmployeeDTO();
        $dto->setId( $employee->getId());
        $dto->setUserNumber($employee->getUserNumber());
        $dto->setUsername($employee->getUsername());
        $dto->setPassword($employee->getPassword());
        $dto->setFullName($employee->getFullName());
        $dto->setPhone($employee->getPhone());
        $dto->setOfficeId($employee->getOfficeId());
        $dto->setOfficeName($employee->getOfficeName());
        $dto->setOffices($this->officeService->getAll());
        return $dto;
    }

    public function allEmployees()
    {
        if (!$this->employeeService->isLogged()) {
            $this->redirect("login.php");
        }
        $this->render('employees/employees',$this->employeeService->getAll());
    }



}