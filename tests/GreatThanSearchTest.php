<?php
/**
 * Created by PhpStorm.
 * User: liqi
 * Date: 2017/12/20
 * Time: 下午1:46
 */

namespace Tests;


use Example\GreaterThanSearch;
use PHPUnit\Framework\TestCase;

class GreatThanSearchTest extends TestCase
{
    /**
     * @dataProvider greatThanDataProvider
     */
    public function testGreaterThan( $params, $expect_condition, $expect_bind )
    {
        $search = new GreaterThanSearch($params);
        list($condition, $bind) = $search->handle();
        $this->assertEquals($expect_condition, $condition);
        $this->assertEquals($expect_bind, $bind);
    }


    public function greatThanDataProvider()
    {
        return [
            'default'      => [
                [ 'g1' => 'gg' ], 'g1 > :g1:', [ 'g1' => 'gg' ]
            ],
            'equal'        => [
                [ 'g2' => 'gg' ], 'g2 >= :g2:', [ 'g2' => 'gg' ]
            ],
            'rename-field' => [
                [ 'g3' => 'gg' ], 'g33 >= :g3:', [ 'g3' => 'gg' ]
            ]
        ];
    }
}
