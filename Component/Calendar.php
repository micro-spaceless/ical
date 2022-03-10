<?php

namespace App\Package\Ical\Component;

use App\Package\Ical\Traits\OutputAware;
use App\Package\Ical\Property\Text;
use App\Package\Ical\Property\PropertyCollectionInterface;
use App\Package\Ical\Traits\PropertyCollection;
use App\Package\Ical\Traits\ComponentCollection;

class Calendar extends Component implements ComponentInterface, ComponentCollectionInterface, PropertyCollectionInterface
{
    const METHOD_PUBLISH = 'PUBLISH';
    const METHOD_REQUEST = 'REQUEST';
    const METHOD_CANCEL = 'CANCEL';


    public $type = 'VCALENDAR';
    public $prodid;
    public $version;
    public $calscale = 'GREGORIAN';
    public $method = self::METHOD_PUBLISH;

    use OutputAware,
        ComponentCollection,
        PropertyCollection;

    public function __construct($prodid = null, $version = '2.0')
    {
        $this->prodid = $prodid ?? '-//edgar2031/Ical v1.0//EN';
        $this->version = $version;
    }

    /**
     * Set method
     *
     * @param string|null $method
     */
    public function setMethod($method = null)
    {
        $this->method = $method ?? self::METHOD_REQUEST;

        return $this;
    }

    protected function assemble()
    {
        $this->addProperty(new Text('PRODID', $this->prodid));
        $this->addProperty(new Text('VERSION', $this->version));
        $this->addProperty(new Text('CALSCALE', $this->calscale));
        $this->addProperty(new Text('METHOD', $this->method));
    }

    public function addEvent(Event $event)
    {
        return $this->addComponent($event);
    }

}
