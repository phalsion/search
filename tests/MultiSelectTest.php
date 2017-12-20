<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 上午11:36
 */

namespace Tests;


use Example\MultiSelectSearch;
use Phalsion\Search\Columns\MultiSelect;
use PHPUnit\Framework\TestCase;

class MultiSelectTest extends TestCase
{
    /**
     * @dataProvider multiSelectDataProvider
     */
    public function testMultiSelect( $params, $expect_condition, $expect_bind )
    {
        $search = new MultiSelectSearch($params);
        list($condition, $bind) = $search->handle();
        $this->assertEquals($expect_condition, $condition);
        $this->assertEquals($expect_bind, $bind);
    }


    public function multiSelectDataProvider()
    {
        return [
            'default'       => [
                [ 'm1' => [ 1, 2, 3 ] ], 'm1 IN ({m1:array})', [ 'm1' => [ 1, 2, 3 ] ],
            ],
            'empty'         => [
                [ 'm1' => [] ], '', [],
            ],
            'null'          => [
                [ 'm1' => null ], '', []
            ],
            'is not array'  => [
                [ 'm1' => 1 ], '', []
            ],
            'contains null' => [
                [ 'm1' => [ 1, null, 3 ] ], 'm1 IN ({m1:array})', [ 'm1' => [ 1, null, 3 ] ],
            ]
        ];
    }
}
