<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 18.12.29
 * Time: 23.05
 */
/**
 * @param $class
 * @param array $attributes
 * @return mixed
 */
function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}