<?php
namespace App\Data;

class TownDTO
{
    private const NAME_MIN_LENGTH = 4;
    private const NAME_MAX_LENGTH = 255;

    private const PROVINCE_MIN_LENGTH = 4;
    private const PROVINCE_MAX_LENGTH = 255;

    private const MUNICIPALITY_MIN_LENGTH = 4;
    private const MUNICIPALITY_MAX_LENGTH = 255;


    private const POSTCODE_MIN_LENGTH = 4;
    private const POSTCODE_MAX_LENGTH = 10;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $province;
    /**
     * @var string
     */
    private $municipality;
    /**
     * @var string
     */
    private $postcode;


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
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TownDTO
     * @throws \Exception
     */
    public function setName(string $name): TownDTO
    {
        DTOValidator::validate(self::NAME_MIN_LENGTH,self::NAME_MAX_LENGTH,
            $name, "text", "Населено място");

        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     *  @return TownDTO
     * @throws \Exception
     */
    public function setProvince(string $province):TownDTO
    {
        DTOValidator::validate(self::PROVINCE_MIN_LENGTH,self::PROVINCE_MAX_LENGTH,
            $province, "text", "Област");
        $this->province = $province;
        return $this;
    }

    /**
     * @return string
     */
    public function getMunicipality(): string
    {
        return $this->municipality;
    }

    /**
     * @param string $municipality
     * * @return TownDTO
     * @throws \Exception
     */
    public function setMunicipality(string $municipality):TownDTO
    {
        DTOValidator::validate(self::MUNICIPALITY_MIN_LENGTH,self::MUNICIPALITY_MAX_LENGTH,
            $municipality, "text", "Община");
        $this->municipality = $municipality;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * * @return TownDTO
     * @throws \Exception
     */
    public function setPostcode(string $postcode):TownDTO
    {
        DTOValidator::validate(self::NAME_MIN_LENGTH,self::NAME_MAX_LENGTH,
            $postcode, "text", "Пощенски код");
        $this->postcode = $postcode;
        return $this;
    }


}