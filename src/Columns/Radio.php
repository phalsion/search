<?php

namespace Bundles\Employee\Search\Column;

use Phalsion\Search\Columns\Column;

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
        return $this->getDbColumn() . ' = :' . $this->getDbColumn() . ':';
    }
}
