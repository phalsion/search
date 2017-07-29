<?php

namespace Tests;


use Example\SectionSearch;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
    public function testSection()
    {
        $data   = [
            'num_max' => '3',
            'num_min' => '4',
        ];
        $search = new SectionSearch($data);

        $this->assertEquals($data, $search->getBind());
        $this->assertEquals('num < :num_max: and num > :num_min:', $search->getConditions());

    }
}
