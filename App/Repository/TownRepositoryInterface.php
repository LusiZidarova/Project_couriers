<?php
namespace App\Repository;

use App\Data\FullTownsDTO;
use App\Data\TownDTO;

interface TownRepositoryInterface
{
    public function add(TownDTO $town);

    /**
     * @return FullTownsDTO[]|\Generator
     */
    public function findAll(): \Generator;

    public function findOne(int $id): TownDTO;

    public function edit(TownDTO $town);

}