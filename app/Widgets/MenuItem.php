<?php


namespace App\Widgets;


use Illuminate\Support\Facades\Route;

class MenuItem
{
    public string $label = '';

    public bool $active = false;

    public string $activeClass = '';

    public string $childrenClass = '';

    public string $itemTemplate = '';

    public string $subItemTemplate = '';

    protected string $url = '';

    /**
     * @var MenuItem[]
     */
    protected array $childItems = [];

    public bool $isActiveRequest = false;

    public function __construct(string $label, string $route, array $childItems = [], bool $active = false)
    {
        $this->label = $label;
        $this->url = $route;
        $this->childItems = $childItems;

        if ($this->isActiveRequest) {
            $this->active = $active;
        } else {
            $this->active = $this->isActive();
        }
    }

    /**
     * @param bool $isActiveRequest
     * @return MenuItem
     */
    public function setIsActiveRequest(bool $isActiveRequest): self
    {
        $this->isActiveRequest = $isActiveRequest;

        return $this;
    }


    protected function isActive(): bool
    {
        return (bool)(Route::currentRouteName() === $this->url);
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
     * @param string $itemTemplate
     * @return MenuItem
     */
    public function setItemTemplate(string $itemTemplate): self
    {
        $this->itemTemplate = $itemTemplate;
        return $this;
    }

    public function render()
    {
        return self::internalRender($this);
    }

    protected static function internalRender(MenuItem $item): string
    {
        $subMenu = '';
        if ($item->hasChild()) {
            $subMenuItems = '';
            foreach ($item->childItems as $childItem) {
                $subMenuItems .= self::internalRender($childItem);
            }

            $subMenu = strtr($item->subItemTemplate, [
                '{items}' => $subMenuItems
            ]);
        }

        return strtr($item->itemTemplate, [
            '{active}' => $item->active ? $item->activeClass : '',
            '{children}' => $item->hasChild() ? $item->childrenClass : '',
            '{label}' => $item->label,
            '{url}' => $item->getUrlRoute(),
            '{subItem}' => $subMenu
        ]);
    }

    /**
     * @param string $activeClass
     * @return MenuItem
     */
    public function setActiveClass(string $activeClass): self
    {
        $this->activeClass = $activeClass;
        return $this;
    }

    /**
     * @param string $childrenClass
     * @return MenuItem
     */
    public function setChildrenClass(string $childrenClass): self
    {
        $this->childrenClass = $childrenClass;
        return $this;
    }

    protected function hasChild(): bool
    {
        return (bool)($this->childItems !== []);
    }

    /**
     * @param string $subItemTemplate
     * @return MenuItem
     */
    public function setSubItemTemplate(string $subItemTemplate): self
    {
        $this->subItemTemplate = $subItemTemplate;
        return $this;
    }

}
