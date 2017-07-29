<?php

namespace Example;


use Phalsion\Search\Columns\KeyWord;
use Phalsion\Search\Search;

/**
 * Class KeyWordSearch
 *
 * @author  saberuster
 * @package Example
 */
class KeyWordSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('key_word', new KeyWord());
        $this->addColumn('key_word2', new KeyWord([ 'field' => 'db_key_word' ]));
        $this->addColumn('left_key_word', new KeyWord([ 'like' => KeyWord::LEFT ]));
        $this->addColumn('convert_key_word',
            new KeyWord(
                [
                    'convert' => function ( $param ) {
                        $param['convert_key_word'] .= '1';

                        return $param;
                    }
                ]
            )
        );

    }
}
