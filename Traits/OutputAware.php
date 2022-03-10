<?php

namespace App\Package\Ical\Traits;

use App\Package\Ical\Output\Output;

trait OutputAware
{
    /**
     * Output
     */
    protected $output;

    /**
     * Set output
     *
     * @param Output $output
     */
    public function setOutput(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Get output
     */
    public function getOutput()
    {
        if (!$this->output) {
            $this->output = new Output();
        }

        return $this->output;
    }
}
