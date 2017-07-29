<?php

namespace Bundles\Employee\Search\Column;


use Phalsion\Search\Columns\Column;

/**
 * Class KeyWord
 *
 * @package \Bundles\Employee\Search\Column
 */
class KeyWord extends Column
{

    //like%位置
    const LEFT  = 1;
    const RIGHT = 2;
    const BOTH  = 3;

    protected $like;

    public function __construct( array $option = [] )
    {
        //默认两边都有%
        $this->like = $option['like'] ?? static::BOTH;

        parent::__construct($option);
    }


    public function condition()
    {
        $likeValue = '';

        switch ( $this->like ) {
            case static::LEFT:
                $likeValue = '%:' . $this->getField() . ':';
                break;
            case static::RIGHT:
                $likeValue = ':' . $this->getField() . ':%';
                break;
            case static::BOTH:
                $likeValue = '%:' . $this->getField() . ':%';
                break;
        }

        return $this->getField() . ' like ' . $likeValue;
    }


}
