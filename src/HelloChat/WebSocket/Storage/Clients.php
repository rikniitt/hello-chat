<?php

namespace HelloChat\WebSocket\Storage;

use SplObjectStorage;
use Ratchet\ConnectionInterface;

class Clients
{
    private $storage;

    public function __construct()
    {
        $this->storage = new SplObjectStorage();
    }

    public function add(ConnectionInterface $client)
    {
        if (!$this->storage->contains($client)) {
            $this->storage->attach($client);
        }

        return $this;
    }

    public function remove(ConnectionInterface $client)
    {
        $this->storage->detach($client);
        return $this;
    }

    public function each(callable $fun)
    {
        foreach ($this->storage as $client) {
            $fun($client);
        }

        return $this;
    }

    public function size()
    {
        return $this->storage->count();
    }
}
