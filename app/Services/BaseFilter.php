<?php

namespace App\Services;

abstract class BaseFilter
{

    protected $name='default';

    protected $view='input';

    abstract function filtered($query, $value);
    abstract function getFilters();


}
