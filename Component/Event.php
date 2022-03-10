<?php

namespace App\Package\Ical\Component;


use App\Package\Ical\Traits\OutputAware;
use App\Package\Ical\Property\DateTimeStamp;
use App\Package\Ical\Property\Text;
use App\Package\Ical\Property\PropertyCollectionInterface;
use App\Package\Ical\Traits\PropertyCollection;
use App\Package\Ical\Traits\ComponentCollection;
use DateTime;
use Exception;

class Event extends Component implements ComponentInterface, ComponentCollectionInterface, PropertyCollectionInterface
{
    use OutputAware,
        ComponentCollection,
        PropertyCollection;

    const STATUS_TENTATIVE = 'TENTATIVE';
    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_CANCELLED = 'CANCELLED';

    public $type = 'VEVENT';
    public $status = self::STATUS_CONFIRMED;
    public $dtstamp;
    public $uid;
    public $start;
    public $end;
    public $summary;
    public $description;
    public $location;
    public $sequence = -1;
    public $url;
    public $dateFormat = DateTimeStamp::DEFAULT_FORMAT;

    public function __construct($uid = null, DateTime $dtstamp = null)
    {
        $this->uid = $uid ?? uniqid();
        $this->dtstamp = $dtstamp ?? new DateTime('now');
    }

    /**
     * Set start date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function start(DateTime $date)
    {
        $this->start = $date;
        return $this;
    }

    /**
     * Set end date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function end(DateTime $date)
    {
        $this->end = $date;
        return $this;
    }

    /**
     * Shortcut from start and end dates
     *
     * @param \DateTime $start
     * @param \DateTime $end
     * @return Event
     */
    public function dateBetween(DateTime $start, DateTime $end)
    {
        $this->start($start)->end($end);
        return $this;
    }


    /**
     * Set summary
     *
     * @param string|null $summary
     * @return Event
     */
    public function summary($summary = null)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Set description
     *
     * @param string|null $description
     * @return Event
     */
    public function description($description = null)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set location
     *
     * @param string|null $location
     * @return Event
     */
    public function location($location = null)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Set sequence
     *
     * @param integer $sequence
     * @return Event
     */
    public function sequence(int $sequence = 0)
    {
        $this->sequence = $sequence;
        return $this;
    }

    /**
     * Set status
     *
     * @param string|null $status
     * @return Event
     */
    public function status($status = null)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set dateFormat
     *
     * @param string|null $dateFormat
     * @return Event
     */
    public function dateFormat($dateFormat = null)
    {
        $this->dateFormat = $dateFormat;
        return $this;
    }

    /**
     * Aassemble
     */
    protected function assemble()
    {
        if (!$this->start || !$this->end) {
            throw new Exception('Start and end dates must be set on an event');
        }

        if ($this->start > $this->end) {
            throw new Exception('Start date must be before end date');
        }

        $this->addProperty(new DateTimeStamp('DTSTAMP', $this->dtstamp));
        $this->addProperty(new Text('UID', $this->uid));
        $this->addProperty(new DateTimeStamp('DTSTART', $this->start, $this->dateFormat));
        $this->addProperty(new DateTimeStamp('DTEND', $this->end, $this->dateFormat));
        $this->addProperty(new Text('STATUS', $this->status));

        if ($this->summary) {
            $this->addProperty(new Text('SUMMARY', $this->summary));
        }

        if ($this->description) {
            $this->addProperty(new Text('DESCRIPTION', $this->description));
        }

        if ($this->location) {
            $this->addProperty(new Text('LOCATION', $this->location));
        }

        if ($this->sequence >= 0) {
            $this->addProperty(new Text('SEQUENCE', $this->sequence));
        }
    }

}
