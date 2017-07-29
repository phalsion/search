<?php

namespace Bundles\Employee\Search\Column;


use Phalcon\Config;

/**
 * Class Section
 *
 * @package \Bundles\Employee\Search\Column
 */
class Section extends SearchColumn
{

    protected $max;

    protected $min;

    protected $suffix_max;

    protected $suffix_min;

    public function __construct( $option = [] )
    {
        $this->max = $option['max'] ?? null;
        $this->min = $option['min'] ?? null;

        $this->suffix_max = $option['suffix_max'] ?? '_max';
        $this->suffix_min = $option['suffix_min'] ?? '_min';

        parent::__construct($option);
    }


    public function condition()
    {
        $section = [];
        if ( $this->max ) {
            $section[] = $this->getDbColumn() . ' < :' . $this->getDbColumn() . '_end:';
        }
        if ( $this->min ) {
            $section[] = $this->getDbColumn() . ' > :' . $this->getDbColumn() . '_start:';
        }

        return implode(' and ', $section);
    }

    public function getBindValue()
    {
        return [
            $this->getDbColumn() . '_end'   => $this->max,
            $this->getDbColumn() . '_start' => $this->min,
        ];
    }

    public function getValue()
    {


        return true;
    }

    public function data( $field, Config $params )
    {
        $r = parent::data($field, $params);
        if ( false === $r ) {
            return false;
        }

        $this->max = $params->path($field . $this->suffix_max);
        $this->min = $params->path($field . $this->suffix_min);

        if ( null === $this->max && null === $this->min ) {
            return false;
        }
    }
}
