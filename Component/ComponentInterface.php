<?php

namespace App\Package\Ical\Component;

use App\Package\Ical\Output\OutputAwareInterface;
use App\Package\Ical\Output\ToIcalInterface;

interface ComponentInterface extends ToIcalInterface, OutputAwareInterface
{
    //
}
