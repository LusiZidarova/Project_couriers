<?php

namespace App\Data;


class EditOfficeDTO extends OfficeDTO
{
    private $towns;

    /**
     * @return TownDTO[]|\Generator
     */
    public function getTowns():\Generator
    {
        return $this->towns;
    }

    /**
     * @param mixed $towns
     */
    public function setTowns($towns): void
    {
        $this->towns = $towns;
    }








}