<?php

namespace App\Package\Ical\Traits;

use App\Package\Ical\Property\PropertyInterface;

trait PropertyCollection
{
    /**
     * Properties
     *
     * @var array
     */
    protected $properties = [];

    /**
     * Add properties
     *
     * @param array $properties
     */
    public function addProperties(array $properties)
    {
        foreach ($properties as $property) {
            $this->addProperty($property);
        }

        return $this;
    }

    /**
     * Add property
     *
     * @param PropertyInterface $property
     */
    public function addProperty(PropertyInterface $property)
    {
        $this->properties[] = $property;
        return $this;
    }

    /**
     * Get properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

}
