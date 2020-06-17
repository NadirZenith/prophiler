<?php
/**
 * @author @fabfuel <fabian@fabfuel.de>
 * @created 14.11.14, 08:39
 */

namespace Fabfuel\Prophiler\Plugin\Phalcon\Db;

use Fabfuel\Prophiler\Benchmark\BenchmarkInterface;
use Fabfuel\Prophiler\Plugin\PluginAbstract;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Events\EventInterface;

/**
 * Class AdapterPlugin
 */
class AdapterPlugin extends PluginAbstract
{
    /**
     * @var BenchmarkInterface
     */
    private BenchmarkInterface $benchmark;

    /**
     * Start the query benchmark
     *
     * @param EventInterface $event
     * @param AdapterInterface $database
     */
    public function beforeQuery(EventInterface $event, AdapterInterface $database)
    {
        $metadata = [
            'query' => $database->getSQLStatement(),
        ];
        $params = $database->getSQLVariables();
        if (isset($params)) {
            $metadata['params'] = $params;
        }
        $bindtypes = $database->getSQLBindTypes();
        if (isset($bindtypes)) {
            $metadata['bindTypes'] = $bindtypes;
        }
        $desc = $database->getDescriptor();
        if (isset($desc['dbname'])) {
            $metadata['database'] = $desc['dbname'];
        }

        $this->benchmark = $this->getProfiler()->start(get_class($event->getSource()) . '::query', $metadata, 'Database');
    }

    /**
     * Stop the query benchmark
     */
    public function afterQuery()
    {
        $this->getProfiler()->stop($this->benchmark);
    }
}
