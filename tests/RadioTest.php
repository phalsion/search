<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 上午11:44
 */

namespace Tests;


use Example\RadioSearch;
use PHPUnit\Framework\TestCase;

class RadioTest extends TestCase
{
    /**
     * @dataProvider radioDataProvider
     */
    public function testRadio( $params, $expect_condition, $expect_bind )
    {
        $search = new RadioSearch($params);
        list($condition, $bind) = $search->handle();
        $this->assertEquals($expect_condition, $condition);
        $this->assertEquals($expect_bind, $bind);
    }


    public function radioDataProvider()
    {
        return [
            'default'      => [
                [ 'r1' => 'asd' ], 'r1 = :r1:', [ 'r1' => 'asd' ]
            ],
            'null'         => [
                [ 'r1' => null ], '', []
            ],
            'empty'        => [
                [ 'r1' => '' ], 'r1 = :r1:', [ 'r1' => '' ]
            ],
            'rename-field' => [
                [ 'r2' => '' ], 'r22 = :r2:', [ 'r2' => '' ]
            ]
        ];
    }
}
