<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 上午11:45
 */

namespace Example;


use Phalsion\Search\Columns\Radio;
use Phalsion\Search\Search;

class RadioSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('r1', new Radio());
        $this->addColumn('r2', new Radio([ 'field' => 'r22' ]));
    }
}
