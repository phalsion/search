<?php

namespace Phalsion\Search\Columns;

/**
 * Class Section
 *
 * @author  saberuster
 * @package Bundles\Employee\Search\Column
 */
class Section extends Column
{

    private $_suffix_max;

    private $_suffix_min;

    public function __construct( $option = [] )
    {
        $this->setSuffixMax($option['suffix_max'] ?? '_max');
        $this->setSuffixMin($option['suffix_min'] ?? '_min');

        parent::__construct($option);
    }


    public function condition()
    {
        $section = [];
        if ( $this->getMax() ) {
            $section[] = sprintf("%s < :%s:", $this->getDbField(), $this->getMaxField());
        }
        if ( $this->getMin() ) {
            $section[] = sprintf("%s > :%s:", $this->getDbField(), $this->getMinField());
        }

        return implode(' and ', $section);
    }

    public function values(): array
    {
        return [
            $this->getMaxField() => $this->getMax(),
            $this->getMinField() => $this->getMin(),
        ];
    }


    public function getMaxField()
    {
        return $this->getField() . $this->getSuffixMax();
    }

    public function getMinField()
    {
        return $this->getField() . $this->getSuffixMin();
    }


    /**
     * @return mixed|null
     */
    public function getMax()
    {
        return $this->getParam(
                $this->getMaxField()
            ) ?? null;
    }


    /**
     * @return mixed|null
     */
    public function getMin()
    {
        return $this->getParam(
                $this->getMinField()
            ) ?? null;
    }

    /**
     * @return mixed
     */
    public function getSuffixMax()
    {
        return $this->_suffix_max;
    }

    /**
     * @param mixed $suffix_max
     */
    public function setSuffixMax( $suffix_max )
    {
        $this->_suffix_max = $suffix_max;
    }

    /**
     * @return mixed
     */
    public function getSuffixMin()
    {
        return $this->_suffix_min;
    }

    /**
     * @param mixed $suffix_min
     */
    public function setSuffixMin( $suffix_min )
    {
        $this->_suffix_min = $suffix_min;
    }
}
