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
        return $this->getDbField() . ' IN ({' . $this->getField() . ':array})';
    }

    public function values(): array
    {
        $field = $this->getField();
        $v     = $this->getParam($field);
        if ( is_array($v) && !empty($v) ) {
            return [ $field => $v ];
        } else {
            return [];
        }
    }


}
