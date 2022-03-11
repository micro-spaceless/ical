<?php

namespace MicroSpaceless\Ical\Traits;

use MicroSpaceless\Ical\Component\ComponentInterface;

trait ComponentCollection
{
    /**
     * Components
     *
     * @var array
     */
    protected $components = [];

    /**
     * Add components
     *
     * @param array $components
     */
    public function addComponents(array $components)
    {
        foreach ($components as $component) {
            $this->addComponent($component);
        }

        return $this;
    }


    /**
     * Add component
     *
     * @param ComponentInterface $component
     */
    public function addComponent(ComponentInterface $component)
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * Get components
     */
    public function getComponents()
    {
        return $this->components;
    }
}
