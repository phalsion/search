<?php

namespace Tests;


use Example\MultiSearch;
use PHPUnit\Framework\TestCase;

class MultiSelectTest extends TestCase
{
    public function testSelect()
    {
        $data   = [ 'select' => [ 1, 2, 3 ] ];
        $search = new MultiSearch($data);
        $this->assertEquals($data, $search->getBind());
        $this->assertEquals('select IN ({select:array})', $search->getConditions());
    }
}
