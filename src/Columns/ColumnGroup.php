<?php

namespace Phalsion\Search\Columns;


use Phalsion\Search\InvalidColumnException;
use Phalsion\Search\InvalidFlagException;

class ColumnGroup implements ColumnJoiner
{
    /** @var ColumnInterface[] $_columns */
    protected $_columns;
    protected $_parent;
    protected $_flag;


    public function __construct()
    {
        $this->_columns = [];
        $this->_parent  = null;
        $this->_flag    = Column:: AND;
    }


    public function addColumn( $field, $column, $flag = null )
    {
        if ( $column instanceof ColumnGroup ) {
            $this->_columns[] = $column;
            if ( $flag ) {
                $column->setFlag($flag);
            }

            return;
        }

        if ( $column instanceof Column ) {
            $column->setField($field);
            $column->setParam($this->getParams());
            $this->_columns[] = $column;
            if ( $flag ) {
                $column->setFlag($flag);
            }

            return;
        }

        throw new InvalidColumnException(sprintf('method addColumn\'s second column must be instanceof %s or %s', ColumnGroup::class, ColumnInterface::class));
    }


    public function handle()
    {
        $conditions = '';
        $binds      = [];
        $op         = null;
        foreach ( $this->_columns as $column ) {
            list($condition, $bind) = $column->handle();
            if ( empty($bind) ) {
                continue;
            }
            if ( $op ) {
                $conditions .= $op;
            }

            switch ( $column->getFlag() ) {
                case Column:: AND:
                    $op = ' and ';
                    break;
                case Column:: OR:
                    $op = ' or ';
                    break;
                default:
                    throw new InvalidFlagException(sprintf('flag: %s is invalid', $column->getFlag()));
            }

            if ( $column instanceof ColumnGroup && count($bind) > 1 ) {
                $condition = sprintf('(%s)', $condition);
            }
            $conditions .= $condition;
            $binds      = array_merge($binds, $bind);
        }

        return [ $conditions, $binds ];
    }


    public function getParams()
    {
        if ( $this->getParent() ) {
            return $this->getParent()->getParams();
        }

        return [];
    }

    /**
     * @return \Phalsion\Search\Columns\ColumnGroup
     */
    public function getParent()
    {
        return $this->_parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent( $parent )
    {
        $this->_parent = $parent;
    }


    public function getFlag()
    {
        return $this->_flag;
    }


    public function setFlag( $flag )
    {
        $this->_flag = $flag;
    }


}
