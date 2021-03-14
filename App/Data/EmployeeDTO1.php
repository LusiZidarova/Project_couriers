<?php
namespace App\Data;

class EmployeeDTO
{
    private const FULLNAME_MIN_LENGTH = 4;
    private const FULLNAME_MAX_LENGTH = 255;

    private const PASSWORD_MIN_LENGTH = 4;
    private const PASSWORD_MAX_LENGTH = 255;

    private $id;
    private $userNumber;
    private $username;
    private $password;
    private $fullName;
    private $phone;
    private $officeId;
    private $officeName;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id): EmployeeDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserNumber()
    {
        return $this->userNumber;
    }

    /**
     * @param mixed $userNumber
     */
    public function setUserNumber($userNumber): EmployeeDTO
    {
        $this->userNumber = $userNumber;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): EmployeeDTO
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return EmployeeDTO
     * @throws \Exception
     */
    public function setPassword($password): EmployeeDTO
    {
        DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,
            $password, "password", "Password");
        $this->password = $password;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param $fullName
     * @return EmployeeDTO
     * @throws \Exception
     */
    public function setFullName($fullName): EmployeeDTO
    {
        DTOValidator::validate(self::FULLNAME_MIN_LENGTH, self::FULLNAME_MAX_LENGTH,
            $fullName, "text", "Full Name");
        $this->fullName= $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getOfficeId()
    {
        return $this->officeId;
    }

    /**
     * @param mixed $officeId
     */
    public function setOfficeId($officeId): void
    {
        $this->officeId = $officeId;
    }

    /**
     * @return mixed
     */
    public function getOfficeName()
    {
        return $this->officeName;
    }

    /**
     * @param mixed $officeName
     */
    public function setOfficeName($officeName): void
    {
        $this->officeName = $officeName;
    }


}