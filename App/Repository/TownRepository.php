<?php

namespace App\Repository;

use App\Data\FullTownsDTO;
use App\Data\TownDTO;
use Database\DatabaseInterface;
use App\Repository\DatabaseAbstract;
use Core\DataBinderInterface;
use App\Repository\TownRepositoryInterface;
use Generator;

class TownRepository extends DatabaseAbstract implements TownRepositoryInterface
{
    public function add(TownDTO $town)
    {
        $this->db->query("INSERT INTO 
        towns (name, province,municipality, postcode) 
        VALUES (?, ?, ?, ?)")
            ->execute([
                $town->getName(),
                $town->getProvince(),
                $town->getMunicipality(),
                $town->getPostcode()
            ]);
    }

    /**
     * @param int $id
     * @return TownDTO
     */
    public function findOne(int $id):TownDTO
    {
       return $this->db->query("
	         SELECT 
	             id,
	             name,
	             province,
	             municipality,
	             postcode
             FROM towns                     
             WHERE id = ?
             ORDER BY 
                  name "
       )->execute([$id])->fetchOne(TownDTO::class);
    }

    /**
     * @return FullTownsDTO[]|Generator
     */
    public function findAll(): Generator
    {
        return $this->db->query(
            "SELECT
                        id,
                        name,
                        province,
                        municipality,
                        postcode
                   FROM
                    towns 
                    ORDER BY name DESC 
            "
        )->execute()->fetch(FullTownsDTO::class);
    }

    public function edit(TownDTO $town)
    {
        $this->db->query(
            "UPDATE towns SET
                        name = ?,
                        province = ?,
                        municipality =?,
                        postcode = ?
                        WHERE id = ?"
        )->execute([
            $town->getName(),
            $town->getProvince(),
            $town ->getMunicipality(),
            $town->getPostcode(),
            $town->getId()
        ]);
    }
    }