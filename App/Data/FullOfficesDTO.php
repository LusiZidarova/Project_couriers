<?php

namespace App\Data;


class FullOfficesDTO
{
    private $id;
    private $officeName;
    private $manager;
    private $address;
    private $phone;
    private $working_hours;
    private $townId;
    private $townName;

    /**
     * @return int
     */
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

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager): void
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
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
    public function getWorkingHours()
    {
        return $this->working_hours;
    }

    /**
     * @param mixed $working_hours
     */
    public function setWorkingHours($working_hours): void
    {
        $this->working_hours = $working_hours;
    }

    /**
     * @return mixed
     */
    public function getTownId()
    {
        return $this->townId;
    }

    /**
     * @param mixed $townId
     */
    public function setTownId($townId): void
    {
        $this->townId = $townId;
    }

    /**
     * @return mixed
     */
    public function getTownName()
    {
        return $this->townName;
    }

    /**
     * @param mixed $townName
     */
    public function setTownName($townName): void
    {
        $this->townName = $townName;
    }




}