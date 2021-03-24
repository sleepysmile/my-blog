<?php


namespace App\Widgets;


use App\Traits\InstanceTrait;

class Menu
{
    use InstanceTrait;

    public string $wrapTemplate = '<ul>{items}</ul>';

    public string $itemTemplate = '<li class="{active} {children}"><a href="{url}">{label}</a>{subItem}</li>';

    public string $subItemTemplate = '<ul class="sub-menu">{items}</ul>';

    public string $activeClass = 'active';

    public string $childrenClass = 'has-children';

    public bool $isActiveRequest = false;

    protected array $itemStack = [];

    public function add(MenuItem $item): self
    {
        $this->itemStack[] = $this->renderItem($item);

        return $this;
    }

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
    public function setIsActiveRequest(bool $isActiveRequest): Menu
    {
        $this->isActiveRequest = $isActiveRequest;
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
     * @param string $wrapTemplate
     * @return Menu
     */
    public function setWrapTemplate(string $wrapTemplate): self
    {
        $this->wrapTemplate = $wrapTemplate;

        return $this;
    }

    protected function renderItem(MenuItem $item): string
    {
        $item->setIsActiveRequest($this->isActiveRequest);
        $item->setItemTemplate($this->itemTemplate);
        $item->setActiveClass($this->activeClass);
        $item->setChildrenClass($this->childrenClass);
        $item->setSubItemTemplate($this->subItemTemplate);

        return $item->render();
    }

}
