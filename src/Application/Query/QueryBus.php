<?php

namespace App\Application\Query;

class QueryBus
{
    private $handlers = [];

    public function registerHandler(string $queryClass, $handler)
    {
        $this->handlers[$queryClass] = $handler;
    }

    public function handle($query)
    {
        $queryClass = get_class($query);
        if (!isset($this->handlers[$queryClass])) {
            throw new \Exception("No handler registered for query $queryClass");
        }
        return $this->handlers[$queryClass]->handle($query);
    }
}
