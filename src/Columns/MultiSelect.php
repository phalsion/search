<?php

namespace Bundles\Employee\Search\Column;


use Phalsion\Search\Columns\Column;

/**
 * Class MultiSelect
 *
 * @author  saberuster
 * @package Bundles\Employee\Search\Column
 */
class MultiSelect extends Column
{

    public function condition()
    {
        return $this->getDbColumn() . ' IN ({' . $this->getField() . ':array})';
    }


}
