<?php

namespace App\Data;


class DTOValidator
{
    /**
     * @param $min
     * @param $max
     * @param $value
     * @param $type
     * @param $fieldName
     * @throws \Exception
     */
    public static function validate($min, $max, $value, $type, $fieldName=null)
    {

        if ($type === "text" && $fieldName !== "postcode") {
            if (mb_strlen($value) < $min || mb_strlen($value) > $max) {
                throw new \Exception("Полето {$fieldName} трябва да е между  $min и $max символа!");
            }
        } else if($fieldName === "postcode") {
                if($value < 0 || $value > 10){

                    throw new \Exception("{$fieldName} числото трябва да бъде положително и по-малко от 10 !");
                }
            }
        }


}