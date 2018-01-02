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
    const AND = 0;
    const OR  = 1;

    private $_param;
    private $_field_name;
    private $_allow_empty;
    private $_callback;
    private $_flag;

    /**
     * 数据库中对应的字段
     *
     * @var string|null $_db_field
     */
    private $_db_field;

    public function __construct( array $option = [] )
    {
        $this->_db_field    = $option['field'] ?? null;
        $this->_callback    = $option['convert'] ?? null;
        $this->_allow_empty = (bool) ( $option['empty'] ?? true );
    }

    /**
     * 该方法返回的字符串用于phalcon的数据库查询
     *
     * @return string
     */
    abstract public function condition();


    public function values(): array
    {
        return [
            $this->getField() => $this->getParam($this->getField())
        ];
    }

    /**
     * @inheritdoc
     */
    public function getBind()
    {
        $bind = $this->values();
        foreach ( $bind as $k => $item ) {
            if ( null === $item ) {
                unset($bind[ $k ]);
            }
        }

        return $bind;
    }

    public function handle()
    {
        return [ $this->getCondition(), $this->getBind() ];
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

    public function allowEmpty()
    {
        return $this->_allow_empty;
    }

    public function getFlag()
    {
        return $this->_flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag( $flag )
    {
        $this->_flag = $flag;
    }
}
