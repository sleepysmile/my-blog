<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Route;

/**
 * Class MenuItem
 *
 * Класс представляющий элемент меню
 * @package App\Widgets
 */
class MenuItem
{
    /** @var string - Текст в эл. меню */
    public string $label = '';

    /** @var bool - Активный ли элемент меню */
    public bool $active = false;

    /** @var string - класс активного элемента */
    protected static string $activeClass = '';

    /** @var string - класс списка дочерних элеменна */
    protected static string $childrenClass = '';

    /** @var string - шаблон формирования одного элемента списка */
    protected static string $itemTemplate = '';

    /** @var string - шаблон формирования подменю */
    protected static string $subItemTemplate = '';

    /** @var bool - делать ли проверку на активный элемент с url-ом */
    protected static bool $isActiveRequest = false;

    /** @var bool - Отображать ли открытый список меню при активном наследнике */
    protected static bool $isChildActive = false;

    /** @var string - класс для открытия элемента меню */
    protected static string $openClass = '';

    /** @var string - класс для отображения субменю */
    protected static string $showSubmenuClass = '';

    /** @var string - ссылка формат route.name */
    protected string $url = '';

    /**
     * @var MenuItem[]
     */
    protected array $childItems = [];

    public function __construct(string $label, string $route, array $childItems = [], bool $active = false)
    {
        $this->label = $label;
        $this->url = $route;
        $this->childItems = $childItems;

        if (self::$isActiveRequest) {
            $this->active = $active;
        } else {
            $this->active = $this->isActive();
        }
    }

    /**
     * Проверка аткивного элемента в соттвествии с url-ом
     *
     * @return bool
     */
    protected function isActive(): bool
    {
        return (bool)(Route::currentRouteName() === $this->url);
    }

    /**
     * @param string $showSubmenuClass
     * @return MenuItem
     */
    public function setShowSubmenuClass(string $showSubmenuClass): self
    {
        self::$showSubmenuClass = $showSubmenuClass;
        return $this;
    }

    /**
     * @param string $openClass
     * @return MenuItem
     */
    public function setOpenClass(string $openClass): self
    {
        self::$openClass = $openClass;
        return $this;
    }

    /**
     * @param string $activeClass
     * @return MenuItem
     */
    public function setActiveClass(string $activeClass): self
    {
        self::$activeClass = $activeClass;
        return $this;
    }

    /**
     * @param string $childrenClass
     * @return MenuItem
     */
    public function setChildrenClass(string $childrenClass): self
    {
        self::$childrenClass = $childrenClass;
        return $this;
    }

    /**
     * @param bool $isChildActive
     */
    public function setIsChildActive(bool $isChildActive): self
    {
        self::$isChildActive = $isChildActive;
        return $this;
    }

    /**
     * @param string $subItemTemplate
     * @return MenuItem
     */
    public function setSubItemTemplate(string $subItemTemplate): self
    {
        self::$subItemTemplate = $subItemTemplate;
        return $this;
    }

    /**
     * @param string $itemTemplate
     * @return MenuItem
     */
    public function setItemTemplate(string $itemTemplate): self
    {
        self::$itemTemplate = $itemTemplate;
        return $this;
    }

    /**
     * @param bool $isActiveRequest
     * @return MenuItem
     */
    public function setIsActiveRequest(bool $isActiveRequest): self
    {
        self::$isActiveRequest = $isActiveRequest;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrlRoute(): string
    {
        if (Route::has($this->url)) {
            return route($this->url);
        }

        return $this->url;
    }

    /**
     * @return string
     */
    protected function getSubmenuClass()
    {
        return self::$showSubmenuClass ? 'class="' . self::$showSubmenuClass. '"' : 'style="display: block"';
    }

    /**
     * Внешняя функция рендеринга элементов меню
     *
     * @return string
     */
    public function render()
    {
        return self::internalRender($this);
    }

    /**
     * Внутренний рекурсивный рендеринг элементов меню
     *
     * @param MenuItem $item
     * @return string
     */
    protected static function internalRender(MenuItem $item): string
    {
        $subItemActive = false;
        $subMenu = '';
        if ($item->hasChild()) {
            $subMenuItems = '';
            foreach ($item->childItems as $childItem) {
                $subMenuItems .= self::internalRender($childItem);
                $subItemActive = $childItem->isActive();
            }
            $subMenu = strtr(self::$subItemTemplate, [
                '{items}' => $subMenuItems,
                '{showSubmenuClass}' => $subItemActive ? $item->getSubmenuClass() : '',
            ]);
        }

        return strtr(self::$itemTemplate, [
            '{active}' => $item->active ? self::$activeClass : '',
            '{children}' => $item->hasChild() ? self::$childrenClass : '',
            '{label}' => $item->label,
            '{url}' => $item->getUrlRoute(),
            '{subItem}' => $subMenu,
            '{openClass}' => $subItemActive ? self::$openClass : '',
        ]);
    }

    /**
     * @return bool
     */
    protected function hasChild(): bool
    {
        return (bool)($this->childItems !== []);
    }

}
