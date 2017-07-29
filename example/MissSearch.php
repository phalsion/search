<?php

namespace Example;


use Phalsion\Search\Columns\KeyWord;
use Phalsion\Search\Search;

/**
 * Class MissSearch
 *
 * @author  saberuster
 * @package Example
 */
class MissSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('miss_key_word', new KeyWord([ 'empty' => false ]));

    }
}
