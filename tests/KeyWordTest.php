<?php

namespace Tests;


use Example\KeyWordSearch;
use PHPUnit\Framework\TestCase;

class KeyWordTest extends TestCase
{

    /**
     * @dataProvider keyWordDataProvider
     */
    public function testKeyWord( $params, $expect_condition, $expect_bind )
    {
        $search = new KeyWordSearch($params);
        list($condition, $bind) = $search->handle();
        $this->assertEquals($expect_condition, $condition);
        $this->assertEquals($expect_bind, $bind);
    }

    public function keyWordDataProvider()
    {
        return [
            'default'                => [
                [ 'key_word' => 'name' ], 'key_word like :key_word:', [ 'key_word' => '%name%' ]
            ],
            'with field option'      => [
                [ 'key_word2' => 'name' ], 'db_key_word like :db_key_word:', [ 'db_key_word' => '%name%' ]
            ],
            'with left like option'  => [
                [ 'left_key_word' => 'name' ], 'left_key_word like :left_key_word:', [ 'left_key_word' => '%name' ]
            ],
            'with right like option' => [
                [ 'right_key_word' => 'name' ], 'right_key_word like :right_key_word:', [ 'right_key_word' => 'name%' ]
            ],
            'with convert option'    => [
                [ 'convert_key_word' => 'name' ], 'convert_key_word like :convert_key_word:', [ 'convert_key_word' => '%name1%' ],
            ],
            'multi_filed_keyword'    => [
                [ 'multi_filed_keyword' => 'name' ], '(db_key_word1 like :db_key_word1: or db_key_word2 like :db_key_word2:)', [ 'db_key_word1' => '%name%', 'db_key_word2' => '%name%' ]
            ],
            'default with group'     => [
                [ 'key_word3' => 'name' ], 'key_word3 like :key_word3:', [ 'key_word3' => '%name%' ]
            ],
            '5 and 3'                => [
                [ 'key_word5' => 'name5', 'key_word3' => 'name3' ], 'key_word5 like :key_word5: and key_word3 like :key_word3:', [ 'key_word5' => '%name5%', 'key_word3' => '%name3%' ]
            ],
            '5,6 and 3'              => [
                [ 'key_word5' => 'name5', 'key_word6' => 'name6', 'key_word3' => 'name3' ], '(key_word5 like :key_word5: or key_word6 like :key_word6:) and key_word3 like :key_word3:', [ 'key_word5' => '%name5%', 'key_word3' => '%name3%', 'key_word6' => '%name6%' ]
            ],
        ];
    }


}
