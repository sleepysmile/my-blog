<?php

namespace App\Models;

use App\Interfaces\SettingsInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class Settings
 * @package App\Models
 *
 * @property string $option_name
 * @property string $option_value
 * @property string $option_type
 * @property bool $is_internal
 */
class Settings extends Model implements SettingsInterface
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'option_name',
        'option_value',
        'option_type',
        'is_internal',
    ];

    /**
     * Возвращает значение настройки приведенное к типу
     *
     * @return false|string
     */
    public function getValue()
    {
        try {
            $value = $this->option_value;
            if (settype($value, $this->option_type)) {
                return $value;
            }

            return $value;
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public static function getOptionName(): string
    {
        return 'option_name';
    }
}
