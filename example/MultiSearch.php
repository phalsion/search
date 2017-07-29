<?php

namespace Example;


use Phalsion\Search\Columns\MultiSelect;
use Phalsion\Search\Search;

/**
 * Class MultiSearch
 *
 * @author  saberuster
 * @package Example
 */
class MultiSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('select', new MultiSelect());
    }
}
