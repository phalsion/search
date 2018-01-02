<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 上午11:28
 */

namespace Phalsion\Search\Columns;


class GreatThan extends Column
{
    protected $equal;

    public function __construct( array $option = [] )
    {
        $this->equal = $option['equal'] ?? false;
        parent::__construct($option);
    }


    public function condition()
    {
        $op = '>';
        if ( $this->equal ) {
            $op = '>=';
        }

        return sprintf('%s %s :%s:', $this->getDbField(), $op, $this->getField());
    }
}
