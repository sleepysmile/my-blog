<?php

namespace App\Widgets;

use App\Traits\InstanceTrait;

/**
 * Class Menu
 * @package App\Widgets
 */
class Menu
{
    use InstanceTrait;

    /** @var string - шаблон обертки для меню */
    public string $wrapTemplate = '<ul>{items}</ul>';

    /** @var string - шаблон элемента списка */
    public string $itemTemplate = '<li class="{active} {children}"><a href="{url}" class="{openClass}">{label}</a>{subItem}</li>';

    /** @var string - шаблон обертки подменю */
    public string $subItemTemplate = '<ul class="sub-menu" {showSubmenuClass}>{items}</ul>';

    /** @var string - класс активного элемента */
    public string $activeClass = 'active';

    /** @var string - класс элементов у которых есть дочеренее меню */
    public string $childrenClass = 'has-children';

    /** @var string - класс для открытия элемента меню */
    public string $openClass = 'sub-menu-is-open';

    /** @var string - класс для отображения субменю */
    public string $showSubmenuClass = '';

    /** @var bool - делать ли проверку на активный элемент с url-ом */
    public bool $isActiveRequest = false;

    /** @var bool - Отображать ли открытый список меню при активном наследнике */
    protected bool $isChildActive = false;

    /** @var array - внутренний список */
    protected array $itemStack = [];

    /**
     * Добавление элемента меню
     *
     * @param MenuItem $item
     * @return $this
     */
    public function add(MenuItem $item): self
    {
        $this->itemStack[] = $this->renderItem($item);

        return $this;
    }

    /**
     * @return string
     */
    public function build()
    {
        return strtr($this->wrapTemplate, [
            '{items}' => implode(PHP_EOL, $this->itemStack)
        ]);
    }

    /**
     * @param string $itemTemplate
     * @return Menu
     */
    public function setItemTemplate(string $itemTemplate): self
    {
        $this->itemTemplate = $itemTemplate;
        return $this;
    }

    /**
     * @param string $activeClass
     * @return Menu
     */
    public function setActiveClass(string $activeClass): self
    {
        $this->activeClass = $activeClass;

        return $this;
    }

    /**
     * @param bool $isActiveRequest
     * @return Menu
     */
    public function setIsActiveRequest(bool $isActiveRequest): self
    {
        $this->isActiveRequest = $isActiveRequest;
        return $this;
    }

    /**
     * @param bool $isChildActive
     * @return Menu
     */
    public function setIsChildActive(bool $isChildActive): self
    {
        $this->isChildActive = $isChildActive;
        return $this;
    }

    /**
     * @param string $openClass
     * @return Menu
     */
    public function setOpenClass(string $openClass): self
    {
        $this->openClass = $openClass;
        return $this;
    }

    /**
     * @param string $wrapTemplate
     * @return Menu
     */
    public function setWrapTemplate(string $wrapTemplate): self
    {
        $this->wrapTemplate = $wrapTemplate;

        return $this;
    }

    /**
     * @return string
     */
    protected function getWrapTemplate(): string
    {
        return $this->wrapTemplate;
    }

    /**
     * Метод рендеренга элемента меню
     * Передача конфигурации основного меню
     *
     * @param MenuItem $item
     * @return string
     */
    protected function renderItem(MenuItem $item): string
    {
        $item->setIsActiveRequest($this->isActiveRequest);
        $item->setItemTemplate($this->itemTemplate);
        $item->setActiveClass($this->activeClass);
        $item->setChildrenClass($this->childrenClass);
        $item->setSubItemTemplate($this->subItemTemplate);
        $item->setIsChildActive($this->isChildActive);
        $item->setOpenClass($this->openClass);
        $item->setShowSubmenuClass($this->showSubmenuClass);

        return $item->render();
    }

}
