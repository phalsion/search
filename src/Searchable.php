<?php

namespace Phalsion\Search;

/**
 * Interface Searchable
 *
 * @author  saberuster
 * @package Phalsion\Search
 */
interface Searchable
{
    public function getConditions();

    public function getBind();
}
