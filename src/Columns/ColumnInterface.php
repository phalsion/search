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
    /**
     * 设置参数的值
     *
     * @param $param
     *
     * @return void
     */
    public function setParam( $param );

    /**
     * 获取参数绑定的数据
     *
     * @return array
     */
    public function getBind(): array;

    /**
     * 获取字段的条件
     *
     * @return string
     */
    public function getCondition(): string;

    /**
     * 是否允许为空，默认可以为空
     *
     * @return bool
     */
    public function allowEmpty(): bool;

    /**
     *  设置字段
     *
     * @param $field
     *
     * @return mixed
     */
    public function setField( $field );
}
