<?php

namespace App\Interfaces;

/**
 * Контракт для использования resizeManager-а
 *
 * Interface ImageContract
 * @package App\Interfaces
 */
interface ImageContract
{
    public function sizes(): array;

    public function uniqueDirName(): string;

    public function getStorage();
}
