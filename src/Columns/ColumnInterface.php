<?php

namespace Phalsion\Search\Columns;

/**
 * Interface Column
 *
 * @author  saberuster
 * @package Phalsion\Search\Columns
 */
interface ColumnInterface
{
    public function setParam( $param );

    public function allowEmpty();

    public function setField( $field );

    public function getField();

    public function setFlag( $flag );

    public function getFlag();

    public function handle();
}
