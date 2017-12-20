<?php

namespace Phalsion\Search;


use Phalsion\Search\Columns\Column;
use Phalsion\Search\Columns\ColumnGroup;
use Phalsion\Search\Columns\ColumnJoiner;

/**
 * Class Search
 *
 * @author  19 Dec 2017 4:02 PM saberuster
 * @package \Phalsion\Search
 */
abstract class Search extends ColumnGroup implements ColumnJoiner
{

    protected $_params;

    public function __construct( $params )
    {
        parent::__construct();
        $this->_params = $params;
        $this->initialize();
    }

    abstract public function initialize();

    public function addColumnGroup( $callback, $flag = Column:: AND )
    {
        $group = new ColumnGroup();
        $group->setParent($this);
        call_user_func($callback, $group);
        $this->addColumn(null, $group, $flag);
    }


    public function getParams()
    {
        return $this->_params;
    }


}
