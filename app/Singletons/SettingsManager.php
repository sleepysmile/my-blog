<?php


namespace App\Singletons;


use App\Interfaces\SettingsInterface;
use App\Models\Settings;
use App\Traits\InstanceTrait;
use Exception;
use Illuminate\Contracts\Cache\Repository;
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

    /**
     * Cache component
     *
     * @var Repository|null
     */
    public ?Repository $cache = null;

    /**
     * @var string
     */
    public string $settingsClass = \App\Models\Settings::class;

    /** @var string - Ключь кеша настроек */
    protected static string $cacheKey = 'settings_manager';

    /**
     * @var Settings
     */
    protected SettingsInterface $settingsInstance;

    public function __construct(?Repository $cache = null)
    {
        $this->cache = ($cache === null) ? Cache::store('file') : $cache;
        $this->settingsInstance = $this->settingsClass::instance();
    }

    /**
     * @return Collection
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function fields(): Collection
    {
        if ($this->cache->has(self::$cacheKey)) {
            return $this->cache->get(self::$cacheKey);
        }

        return $this->cache->rememberForever(self::$cacheKey, function () {
            return Collection::make($this->settingsInstance::all());
        });
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getModelByName(string $name)
    {
        return $this->fields()
            ->firstWhere($this->settingsInstance::getOptionName(), $name);
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

        $settingsItem = $this->getModelByName($fieldName);

        if ($settingsItem instanceof $this->settingsClass) {
            return $settingsItem->getValue();
        }

        throw new Exception('Not found this settings');
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $type
     * @param bool $isInternal
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function set(string $name, string $value, string $type): bool
    {
        $setting = $this->settingsInstance::query()
            ->create([
                'option_name' => $name,
                'option_value' => $value,
                'option_type' => $type,
            ]);

        if (is_object($setting)) {
            return $this->cacheFlush();
        }

        return false;
    }

    /**
     * @param string $name
     * @param string $value
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function update(string $name, string $value)
    {
        $result = $this->settingsInstance::query()
            ->where($this->settingsInstance::getOptionName(), $name)
            ->orWhere('id', $name)
            ->update([
                'option_value' => $value
            ]);

        return ($result && $this->cacheFlush());
    }

    /**
     * @param string $name
     * @return bool
     */
    public function exist(string $name): bool
    {
        return $this->settingsInstance::query()
            ->where($this->settingsInstance::getOptionName(), $name)
            ->exists();
    }

    /**
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function cacheFlush(): bool
    {
        return $this->cache->delete(self::$cacheKey);
    }

}
