<?php

namespace Phalsion\Search\Columns;

/**
 * Class Column
 *
 * @author  saberuster
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

    /**
     * 数据处理的回调函数
     *
     * @var \Closure|null $_callback
     */
    private $_callback;

    private $_db_field;

    public function __construct( array $option = [] )
    {
        $this->_db_field    = $option['field'] ?? null;
        $this->_callback    = $option['convert'] ?? null;
        $this->_allow_empty = (bool) ( $option['empty'] ?? true );
    }

    abstract public function condition();

    public function values(): array
    {
        return [
            $this->getDbField() => $this->getParam($this->getField())
        ];
    }

    /**
     * @inheritdoc
     */
    public function getBind(): array
    {
        $bind = $this->values();
        foreach ( $bind as $k => $item ) {
            if ( null === $item ) {
                unset($bind[ $k ]);
            }
        }

        return $bind;
    }

    public function setDbField( $db_field )
    {
        $this->_db_field = $db_field;
    }

    public function getDbField()
    {
        return $this->_db_field ?? $this->getField();
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
        if (
            ( $param[ $this->getField() ] ?? false )
            && $this->_callback instanceof \Closure ) {
            $param = call_user_func($this->_callback, $param);
        }
        $this->_param = $param;
    }


    public function getParam( $index = null )
    {
        if ( null === $index ) {
            return $this->_param;
        }

        return $this->_param[ $index ] ?? null;
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
