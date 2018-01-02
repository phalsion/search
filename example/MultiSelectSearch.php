<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 上午11:40
 */

namespace Example;


use Phalsion\Search\Columns\MultiSelect;
use Phalsion\Search\Search;

class MultiSelectSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('m1', new MultiSelect());
        $this->addColumn('m2', new MultiSelect([ 'field' => 'm22' ]));
    }
}
