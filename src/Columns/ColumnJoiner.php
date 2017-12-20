<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/19
 * Time: 下午4:36
 */

namespace Phalsion\Search\Columns;


interface ColumnJoiner
{
    public function addColumn( $field, $column, $flag );

}
