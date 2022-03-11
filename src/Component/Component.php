<?php

namespace MicroSpaceless\Ical\Component;

use MicroSpaceless\Ical\Property\PropertyCollectionInterface;
use MicroSpaceless\Ical\Property\Text;

abstract class Component implements ComponentInterface
{
    /**
     * Assemble
     */
    abstract protected function assemble();

    /**
     * To Ical
     */
    public function toIcal()
    {
        $this->assemble();

        $elements = [];

        $elements[] = new Text('BEGIN', $this->type);

        if ($this instanceof PropertyCollectionInterface) {
            $this->addElementsToArray($elements, $this->getProperties());
        }

        if ($this instanceof ComponentCollectionInterface) {
            $this->addElementsToArray($elements, $this->getComponents());
        }

        $elements[] = new Text('END', $this->type);

        return $this->getOutput()->combine($elements);
    }

    /**
     * Add elements to array
     *
     * @param array $array
     * @param array $elements
     */
    protected function addElementsToArray(array &$array, array $elements)
    {
        array_map(function($property) use (&$array) {
            $array[] = $property;
        }, $elements);

        return $this;
    }

}
