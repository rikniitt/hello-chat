<?php

namespace HelloChat\WebSocket\Storage;

class Messages
{
    const LIMIT = 10;
    private $storage;

    public function __construct()
    {
        $this->storage = [];
    }

    public function add($message)
    {
        $this->storage[] = $message;

        if (count($this->storage) > self::LIMIT) {
            $this->storage = array_slice($this->storage, 1);
        }

        return $this;
    }

    public function getAll()
    {
        return $this->storage;
    }

}
