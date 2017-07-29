<?php

namespace Phalsion\Search\Columns;

/**
 * Class Radio
 *
 * @author  saberuster
 * @package Bundles\Employee\Search\Column
 */
class Radio extends Column
{

    public function condition()
    {
        return $this->getField() . ' = :' . $this->getField() . ':';
    }
}
