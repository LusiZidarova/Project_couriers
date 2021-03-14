<?php

namespace App\Data;


class OfficeDTO
{
    private const NAME_MIN_LENGTH = 4;
    private const NAME_MAX_LENGTH = 100;

    private const MANAGER_MIN_LENGTH = 4;
    private const MANAGER_MAX_LENGTH = 100;

    private const ADDRESS_MIN_LENGTH = 4;
    private const ADDRESS_MAX_LENGTH = 255;


    private const PHONE_MIN = 6;
    private const PHONE_MAX = 12;

    private const WORKINGHOURS_MIN_LENGTH = 6;
    private const WORKINGHOURS_MAX_LENGTH = 255;

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $officeName;
    /**
     * @var string
     */
    private $manager;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $workingHours;

    /**
    * @var int
     */
    private $townId;
    /**
     * @return int
     */

    /**
     * @var string
     */
    private $townName;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getOfficeName():string
    {
        return $this->officeName;
    }

    /**
     * @param string $officeName
     * @return OfficeDTO
     * @throws \Exception
     */
    public function setOfficeName(string $officeName): OfficeDTO
    {
        DTOValidator::validate(self::NAME_MIN_LENGTH,self::NAME_MAX_LENGTH,
            $officeName, "text", "Име на офис");

        $this->officeName = $officeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getManager(): string
    {
        return $this->manager;
    }

    /**
     * @param string $manager
     * * @return OfficeDTO
     * @throws \Exception
     */
    public function setManager(string $manager): OfficeDTO
    {
        DTOValidator::validate(self::MANAGER_MIN_LENGTH,self::MANAGER_MAX_LENGTH,
            $manager, "text", "Управител");
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }


    /**
     * @param string $address
     * @return OfficeDTO
     * @throws \Exception
     */
    public function setAddress(string $address): OfficeDTO
    {
        DTOValidator::validate(self::ADDRESS_MIN_LENGTH,self::ADDRESS_MAX_LENGTH,
            $address, "text", "Адреса");
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return OfficeDTO
     * @throws \Exception
     */
    public function setPhone(string $phone): OfficeDTO
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkingHours(): string
    {
        return $this->workingHours;
    }

    /**
     * @param string $workingHours
     * @return OfficeDTO
     * @throws \Exception
     */
    public function setWorkingHours(string $workingHours): OfficeDTO
    {
        DTOValidator::validate(self::WORKINGHOURS_MIN_LENGTH,self::WORKINGHOURS_MAX_LENGTH,
            $workingHours, "text", "Символите на работното време");
        $this->workingHours = $workingHours;
        return $this;
    }

    /**
     * @return int
     */
    public function getTownId(): int
    {
        return $this->townId;
    }

    /**
     * @param int $townId
     */
    public function setTownId(int $townId): void
    {
        $this->townId = $townId;
    }

    /**
     * @return string
     */
    public function getTownName(): string
    {
        return $this->townName;
    }

    /**
     * @param string $townName
     */
    public function setTownName(string $townName): void
    {
        $this->townName = $townName;
    }



}