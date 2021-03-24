<?php

namespace App\Traits;

/**
 * Trait InstanceTrait
 * @package App\Traits
 */
trait InstanceTrait
{
    /**
     * @return static
     */
    public static function instance()
    {
        return new static();
    }
}
