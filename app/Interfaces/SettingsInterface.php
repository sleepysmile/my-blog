<?php


namespace App\Interfaces;


interface SettingsInterface
{
    public static function getOptionName(): string;

    public static function all();
}
