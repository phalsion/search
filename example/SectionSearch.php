<?php

namespace Example;


use Phalsion\Search\Columns\Section;
use Phalsion\Search\Search;

/**
 * Class SectionSearch
 *
 * @author  saberuster
 * @package Example
 */
class SectionSearch extends Search
{


    public function initialize()
    {
        $this->addColumn('num',new Section());
    }
}
