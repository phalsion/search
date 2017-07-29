<?php

namespace Phalsion\Search\Columns;

/**
 * Class KeyWord
 *
 * @author  saberuster
 * @package Phalsion\Search\Columns
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
                $likeValue = '%:' . $this->getDbField() . ':';
                break;
            case static::RIGHT:
                $likeValue = ':' . $this->getDbField() . ':%';
                break;
            case static::BOTH:
                $likeValue = '%:' . $this->getDbField() . ':%';
                break;
        }

        return $this->getDbField() . ' like ' . $likeValue;
    }


}
