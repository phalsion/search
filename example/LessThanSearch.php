<?php

namespace Example;


use Phalsion\Search\Columns\LessThan;
use Phalsion\Search\Search;

class LessThanSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('less1', new LessThan());
        $this->addColumn('less2', new LessThan([ 'equal' => true ]));
        $this->addColumn('less3', new LessThan([ 'equal' => true, 'field' => 'less33' ]));
    }
}
