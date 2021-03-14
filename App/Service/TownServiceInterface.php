<?php
namespace App\Service;

use App\Data\FullTownsDTO;
use App\Data\TownDTO;

interface TownServiceInterface
{
    public function create(TownDTO $town);

    /**
     * @return FullTownsDTO[]|\Generator
     */
    public function getAll(): \Generator;

    public function getOne(int $id): TownDTO;

    public function edit(TownDTO $town);


}