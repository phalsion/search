<?php

namespace Phalsion\Search;

/**
 * Interface Searchable
 *
 * @author  saberuster created_at 2017/7/29上午9:45
 * @package Phalsion\Search
 */
interface Searchable
{
    public function getConditions();

    public function getBind();
}
