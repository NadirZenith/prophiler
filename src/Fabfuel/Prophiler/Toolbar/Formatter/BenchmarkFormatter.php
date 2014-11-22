<?php
/**
 * @author @fabfuel <fabian@fabfuel.de>
 * @created 17.11.14, 07:45 
 */
namespace Fabfuel\Prophiler\Toolbar\Formatter;

class BenchmarkFormatter extends AbstractBenchmarkFormatter implements BenchmarkFormatterInterface
{
    /**
     * @return string
     */
    public function getMemoryUsage()
    {
        return sprintf('%.3f MB', ($this->getBenchmark()->getMemoryUsage() /1024 /1024 ));
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return sprintf('%.2f ms', ($this->getBenchmark()->getDuration() * 1000));
    }

    /**
     * @return double
     */
    public function getStartTime()
    {
        return $this->getBenchmark()->getStartTime();
    }

    /**
     * @return double
     */
    public function getEndTime()
    {
        return $this->getBenchmark()->getEndTime();
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->getBenchmark()->getMetadata();
    }
}
