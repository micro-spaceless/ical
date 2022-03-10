<?php

namespace App\Package\Ical\Property;

use DateTime;


class DateTimeStamp implements PropertyInterface
{
    const DEFAULT_FORMAT = 'Ymd\THis';

    public $key;
    public $value;
    public $format;

    public function __construct($key, DateTime $value, $format = self::DEFAULT_FORMAT)
    {
        $this->key = $this->formatKey($key);
        $this->value = $value;
        $this->format = $format;
    }

    public function formatKey($key)
    {
        return strtoupper(trim($key));
    }

    public function toIcal()
    {
        return $this->key . ':' . $this->value->format($this->format);
    }
}
