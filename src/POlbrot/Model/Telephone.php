<?php

namespace POlbrot\Model;

/**
 * Class Telephone
 */
class Telephone implements \JsonSerializable
{
    private $type = '';
    private $number = '';

    /**
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Telephone
     */
    public function setType($type): Telephone
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return Telephone
     */
    public function setNumber($number): Telephone
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'number' => $this->getNumber()
        ];
    }
}