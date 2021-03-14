<?php
namespace App\Repository;

use App\Data\OfficeDTO;
use App\Data\FullOfficesDTO;


interface OfficeRepositoryInterface
{
    public function add(OfficeDTO $office);

    /**
     * @return FullOfficesDTO[]|\Generator
     */
    public function findAll(): \Generator;

    public function findOne(int $id): OfficeDTO;

    public function edit(OfficeDTO $office);

}