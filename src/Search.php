<?php

namespace Phalsion\Search;


use \Phalsion\Search\Columns\ColumnInterface;

/**
 * Class Search
 *
 * @author  saberuster
 * @package \Phalsion\Search
 */
abstract class Search implements Searchable
{

    /**
     * @var array $params 请求参数
     */
    private $_params;

    /**
     * @var ColumnInterface[] $_searchers
     */
    private $_columns;

    /**
     * @var string[] $_conditions 搜索条件组成的数组
     */
    private $_conditions;

    /**
     * @var array $_binds 参数的绑定列表
     */
    private $_binds;

    public function __construct( array $params )
    {
        $this->setParams($params);
        $this->_binds      = [];
        $this->_conditions = [];
        $this->initialize();
        $this->afterInitialize();
    }

    abstract public function initialize();

    /**
     *
     * @param                 $field  请求数组中对应的键名
     * @param ColumnInterface $column 字段解析实例
     */
    public function addColumn( $field, ColumnInterface $column )
    {
        $this->_columns[ $field ] = $column;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->_params;
    }

    /**
     * @param array $params
     */
    public function setParams( array $params )
    {
        $this->_params = $params;
    }

    /**
     * @param string $condition
     */
    public function addConditions( string $condition )
    {
        $this->_conditions[] = $condition;
    }

    public function getConditions()
    {
        return implode(' and ', $this->_conditions);
    }

    /**
     * @param array $bind 添加where条件的参数绑定
     */
    public function addBind( array $bind )
    {
        $this->_binds = array_merge($this->_binds, $bind);
    }

    public function getBind()
    {
        return $this->_binds;
    }


    protected function afterInitialize()
    {
        foreach ( $this->_columns as $field => $column ) {

            $column->setField($field);

            //设置对应字段的参数的值
            $column->setParam(
                $this->getParams()
            );

            $bind = $column->getBind();
            //如果获取到的条件为空时
            //判断该字段是否允许空值
            //如果不允许空值，抛出异常
            if ( empty($bind) ) {
                if ( !$column->allowEmpty() ) {
                    throw new SearchException();
                }

                continue;
            }

            $condition = $column->getCondition();

            //添加condition
            $this->addConditions($condition);

            //添加bind
            $this->addBind($bind);

        }
    }
}
