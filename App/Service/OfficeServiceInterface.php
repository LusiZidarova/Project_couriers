<?php
namespace App\Service;

use App\Data\OfficeDTO;
use App\Data\FullOfficesDTO;

interface OfficeServiceInterface
{
    public function create(OfficeDTO $office);

    /**
     * @return FullOfficesDTO[]|\Generator
     */
    public function getAll(): \Generator;

    public function getOne(int $id): OfficeDTO;

    public function edit(OfficeDTO $office);


}