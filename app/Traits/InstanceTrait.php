<?php

namespace App\Traits;

/**
 * Trait InstanceTrait
 * @package App\Traits
 */
trait InstanceTrait
{
    public static function instance()
    {
        return new static();
    }
}
