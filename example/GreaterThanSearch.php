<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 下午1:48
 */

namespace Example;


use Phalsion\Search\Columns\GreatThan;
use Phalsion\Search\Search;

class GreaterThanSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('g1', new GreatThan());
        $this->addColumn('g2', new GreatThan([ 'equal' => true ]));
        $this->addColumn('g3', new GreatThan([ 'equal' => true, 'field' => 'g33' ]));
    }
}
