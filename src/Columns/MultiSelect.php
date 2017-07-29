<?php

namespace Phalsion\Search\Columns;


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
        return $this->getDbField() . ' IN ({' . $this->getDbField() . ':array})';
    }


}
