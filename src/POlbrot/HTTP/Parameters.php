<?php

namespace POlbrot\HTTP;

/**
 * Class Parameters
 *
 * @package POlbrot\HTTP
 */
class Parameters
{
    private $values = [];

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getValue(string $key)
    {
        return $this->values[$key] ?? null;
    }

    /**
     * @param string $key
     * @param        $value
     */
    public function setValue(string $key, $value): void
    {
        $this->values[$key] = $value;
    }

}