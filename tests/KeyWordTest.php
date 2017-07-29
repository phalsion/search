<?php

namespace Tests;


use Example\KeyWordSearch;
use Example\MissSearch;
use PHPUnit\Framework\TestCase;

class KeyWordTest extends TestCase
{
    public function testKeyWord()
    {
        $data   = [ 'key_word' => 'search_name' ];
        $search = new KeyWordSearch($data);
        $this->assertEquals($data, $search->getBind());
        $this->assertEquals("key_word like %:key_word:%", $search->getConditions(), $search->getConditions());
    }

    public function testRenameFieldKeyWord()
    {
        $data   = [ 'key_word2' => 'search_name' ];
        $search = new KeyWordSearch($data);
        $this->assertEquals([ 'db_key_word' => 'search_name' ], $search->getBind());
        $this->assertEquals("db_key_word like %:db_key_word:%", $search->getConditions());
    }

    public function testLeftKeyWord()
    {
        $data   = [ 'left_key_word' => 'search_name' ];
        $search = new KeyWordSearch($data);
        $this->assertEquals($data, $search->getBind());
        $this->assertEquals("left_key_word like %:left_key_word:", $search->getConditions(), $search->getConditions());
    }


    public function testConvertKeyWord()
    {
        $data   = [ 'convert_key_word' => 'search_name' ];
        $search = new KeyWordSearch($data);
        $this->assertEquals([ 'convert_key_word' => 'search_name1' ], $search->getBind());
        $this->assertEquals("convert_key_word like %:convert_key_word:%", $search->getConditions(), $search->getConditions());

    }

    /**
     * @expectedException \Phalsion\Search\SearchException
     */
    public function testNotAllowEmptyKeyWord()
    {
        $data   = [ 'convert_key_word' => 'search_name' ];
        $search = new MissSearch($data);
        $search->getBind();
        $search->getConditions();
    }


}
