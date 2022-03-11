<?php

namespace MicroSpaceless\Ical\Output;

class Output
{

    public $eol = "\n";

    /**
     * Combine
     *
     * @param array $elements
     */
    public function combine(array $elements)
    {
        $ical = array_map(function(ToIcalInterface $element) {
            return $element->toIcal();
        }, $elements);

        return implode($this->eol, $ical);
    }

}
