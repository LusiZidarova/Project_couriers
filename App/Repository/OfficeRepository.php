<?php

namespace App\Repository;

use App\Data\OfficeDTO;
use App\Data\FullOfficesDTO;
use Database\DatabaseInterface;
use App\Repository\DatabaseAbstract;
use Core\DataBinderInterface;
use App\Repository\OfficeRepositoryInterface;
use Generator;

class OfficeRepository extends DatabaseAbstract implements OfficeRepositoryInterface
{
    public function add(OfficeDTO $office)
    {
        $this->db->query("INSERT INTO 
        offices (office_name, manager,address, phone, working_hours, town_id) 
        VALUES (?, ?, ?, ?, ?,?)")
            ->execute([$office->getOfficeName(),
                $office->getManager(),
                $office->getAddress(),
                $office->getPhone(),
                $office->getWorkingHours(),
                $office->getTownId()
            ]);
    }

    /**
     * @return FullOfficesDTO[]|Generator
     */
    public function findAll(): Generator
    {
        return $this->db->query(
            "SELECT
                    o.id,
                    o.office_name as officeName,
                    o.manager,
                    o.address,
                    o.phone,
                    o.working_hours as workingHours,
                    o.town_id as townId,
                    t.name as townName
                   FROM
                    offices o
                    JOIN towns t on o.town_id = t.id
                    ORDER BY o.office_name 
            "
        )->execute()->fetch(FullOfficesDTO::class);
    }

    public function edit(OfficeDTO $office)
    {
        $this->db->query(
            "UPDATE offices SET
            office_name = ?,
             manager = ?,
            address =?,
            phone = ?,
            working_hours = ?,      
            town_id = ?
            WHERE id = ?"
        )->execute([
            $office->getOfficeName(),
            $office->getManager(),
            $office->getAddress(),
            $office->getPhone(),
            $office->getWorkingHours(),
            $office->getTownId(),
            $office->getId()
        ]);
    }

    public function findOne(int $id): OfficeDTO
    {
        return $this->db->query(
            "SELECT
                    o.id,
                    o.office_name as officeName,
                    o.manager,
                    o.address,
                    o.phone,
                    o.working_hours as workingHours,
                    o.town_id as townId,
                    t.name as townName
                    
                   FROM
                    offices o
                    JOIN towns t on o.town_id = t.id
                   
                    WHERE o.id = ?"
        )->execute([$id])->fetchOne(OfficeDTO::class);
    }

}