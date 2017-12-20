<?php

namespace Example;


use Phalsion\Search\Columns\Column;
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
        $this->addColumnGroup(function ( $group ) {
            /**
             * @var \Phalsion\Search\Columns\ColumnGroup $group
             */
            $group->addColumn('key_word5', new KeyWord(), Column:: OR);
            $group->addColumn('key_word6', new Keyword());
        }, Column:: AND);

        $this->addColumnGroup(function ( $group ) {
            /**
             * @var \Phalsion\Search\Columns\ColumnGroup $group
             */
            $group->addColumn('key_word3', new KeyWord(), Column:: OR);
            $group->addColumn('key_word4', new Keyword());
        }, Column:: AND);
        $this->addColumn('key_word', new KeyWord());
        $this->addColumn('key_word2', new KeyWord([ 'field' => 'db_key_word' ]));
        $this->addColumn('left_key_word', new KeyWord([ 'like' => KeyWord::LEFT ]));
        $this->addColumn('right_key_word', new KeyWord([ 'like' => KeyWord::RIGHT ]));
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

        $this->addColumn('multi_filed_keyword', new KeyWord([ 'field' => [ 'db_key_word1', 'db_key_word2' ] ]));
    }
}
