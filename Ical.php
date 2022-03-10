<?php

namespace App\Package\Ical;

use App\Package\Ical\Component\Calendar;
use App\Package\Ical\Output\OutputAwareInterface;
use App\Package\Ical\Traits\OutputAware;
use App\Package\Ical\Output\ToIcalInterface;

class Ical implements OutputAwareInterface, ToIcalInterface
{
    use OutputAware;

    protected $calendars = [];

    public function __construct(array $calendars = [])
    {
        foreach ($calendars as $calendar) {
            $this->addCalendar($calendar);
        }
    }

    /**
     * Add calendar
     *
     * @param Calendar $calendar
     * @return Ical
     */
    public function addCalendar(Calendar $calendar)
    {
        $this->calendars[] = $calendar;
        return $this;
    }

    /**
     * To Ical
     */
    public function toIcal()
    {
        $output = $this->getOutput();

        $elements = [];

        foreach ($this->calendars as $calendar)
        {
            $calendar->setOutput($output);
            $elements[] = $calendar;
        }

        return $this->getOutput()->combine($elements);
    }
}
