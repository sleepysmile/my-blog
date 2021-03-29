<?php


namespace App\Singletons;


use App\Traits\InstanceTrait;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class Settings
 * @package App\Singletons
 */
class SettingsManager
{
    use InstanceTrait;

    /**
     *  Название компонента в приожении
     */
    public const SINGLETON_NAME = 'settings';

    /** @var string - Ключь кеша настроек */
    protected static string $cacheKey = 'settings';

    /**
     * @var string
     */
    protected string $settingsClass = \App\Models\Settings::class;

    /**
     * @return Collection
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function fields(): Collection
    {
        $cacheStore = Cache::store('file');

        if ($cacheStore->has(self::$cacheKey)) {
            return $cacheStore->get(self::$cacheKey);
        }

        return $cacheStore->rememberForever(self::$cacheKey, function () {
            return Collection::make($this->settingsClass::all());
        });
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws Exception
     */
    public function get(string $fieldName)
    {
        if ($fieldName === '') {
            throw new Exception('$fieldName is required');
        }

        $settingsItem = $this->fields()
            ->firstWhere($this->settingsClass::getOptionName(), $fieldName);

        if ($settingsItem instanceof $this->settingsClass) {
            return $settingsItem->getValue();
        }

        throw new Exception('Not found this settings');
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $type
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function set(string $name, string $value, string $type): bool
    {
        $setting = $this->settingsClass::create([
            'option_name' => $name,
            'option_value' => $value,
            'option_type' => $type,
        ]);

        if ($setting instanceof $this->settingsClass) {
            if (Cache::store('file')->delete(self::$cacheKey)) {
                return true;
            }
        }

        return false;
    }

}
