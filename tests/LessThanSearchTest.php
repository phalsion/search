<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 下午1:42
 */

namespace Tests;


use Example\LessThanSearch;
use PHPUnit\Framework\TestCase;

class LessThanSearchTest extends TestCase
{
    /**
     * @dataProvider lessThanDataProvider
     */
    public function testLessThan( $params, $expect_condition, $expect_bind )
    {
        $search = new LessThanSearch($params);
        list($condition, $bind) = $search->handle();
        $this->assertEquals($expect_condition, $condition);
        $this->assertEquals($expect_bind, $bind);
    }


    public function lessThanDataProvider()
    {
        return [
            'default' => [
                [ 'less1' => 'less' ], 'less1 < :less1:', [ 'less1' => 'less' ]
            ],
            'equal'   => [
                [ 'less2' => 'less' ], 'less2 <= :less2:', [ 'less2' => 'less' ]
            ]
        ];
    }
}
