<?php

namespace HelloChat\WebSocket\Message;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Exception;

class Chat implements MessageComponentInterface
{

    public function onOpen(ConnectionInterface $conn)
    {

    }

    public function onMessage(ConnectionInterface $from, $msg)
    {

    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }

}
