<?php

namespace Phalsion\Search\Columns;

/**
 * Class LessThan
 *
 * @author  saberuster
 * @package Phalsion\Search\Columns
 */
class LessThan extends Column
{
    protected $equal;

    public function __construct( array $option = [] )
    {
        $this->equal = $option['equal'] ?? false;
        parent::__construct($option);
    }


    public function condition()
    {
        $op = '<';
        if ( $this->equal ) {
            $op = '<=';
        }

        return sprintf('%s %s :%s:', $this->getDbField(), $op, $this->getDbField());
    }
}
