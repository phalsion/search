<?php

namespace Phalsion\Search\Columns;

/**
 * Class Column
 *
 * @author  saberuster created_at 2017/7/29上午9:56
 * @package \Phalsion\Search\Columns
 */
abstract class Column implements ColumnInterface
{

    /**
     * @var mixed 参数的值
     */
    private $_param;

    private $_field_name;

    /**
     * @var bool $_allow_empty
     */
    private $_allow_empty;

    private $_callback;

    public function __construct( array $option )
    {
        $this->_field_name  = $option['field'] ?? null;
        $this->_callback    = $option['convert'] ?? null;
        $this->_allow_empty = (bool) ( $option['empty'] ) ?? true;
    }

    abstract public function condition();

    /**
     * @inheritdoc
     */
    public function getBind(): array
    {
        return [
            $this->getField() => $this->getParam()
        ];
    }

    /**
     * 获取字段的条件
     *
     * @return mixed
     */
    public function getCondition(): string
    {
        return $this->condition();
    }

    /**
     * @inheritdoc
     */
    public function setParam( $param )
    {
        $this->_param = $param;
    }

    public function getParam()
    {
        return $this->_param;
    }

    public function setField( $field )
    {
        if ( !$this->_field_name )
            $this->_field_name = $field;
    }

    public function getField()
    {
        return $this->_field_name;
    }

    /**
     * 是否允许为空，默认可以为空
     *
     * @return mixed
     */
    public function allowEmpty(): bool
    {
        return $this->_allow_empty;
    }
}
