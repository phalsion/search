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

    const LEFT  = 1;
    const RIGHT = 2;
    const BOTH  = 3;

    protected $like;

    public function __construct( array $option = [] )
    {
        $this->like = $option['like'] ?? static::BOTH;

        parent::__construct($option);
    }


    public function condition()
    {
        $conditions = '';
        $mode       = '%s';
        foreach ( $this->mapDbField() as $k => $field ) {
            if ( $k > 0 ) {
                $conditions .= ' or ';
                $mode       = '(%s)';
            }
            $conditions .= sprintf('%s like :%s:', $field, $field);
        }

        return sprintf($mode, $conditions);
    }


    public function values(): array
    {
        $values = [];
        $v      = $this->getParam($this->getField());

        if ( $v === null ) {
            return [];
        }

        switch ( $this->like ) {
            case self::LEFT:
                $v = sprintf('%%%s', $v);
                break;
            case self::RIGHT:
                $v = sprintf('%s%%', $v);
                break;
            case self::BOTH:
                $v = sprintf('%%%s%%', $v);
                break;
            default:
        }
        foreach ( $this->mapDbField() as $field ) {
            $values[ $field ] = $v;
        }

        return $values;
    }


    public function mapDbField()
    {
        if ( is_array($this->getDbField()) ) {
            foreach ( $this->getDbField() as $field ) {
                yield $field;
            }
        } else {
            yield $this->getDbField();
        }
    }


}
