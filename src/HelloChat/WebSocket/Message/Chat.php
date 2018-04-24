<?php

namespace HelloChat\WebSocket\Message;

use HelloChat\WebSocket\Storage\Messages;
use HelloChat\WebSocket\Storage\Clients;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Exception;

class Chat implements MessageComponentInterface
{
    private $messages;
    private $clients;

    public function __construct()
    {
        $this->messages = new Messages();
        $this->clients = new Clients();
    }

    public function onOpen(ConnectionInterface $client)
    {
        $this->clients->add($client);

        foreach ($this->messages->getAll() as $oldMessage) {
            $client->send($oldMessage);
        }
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        $this->messages->add($message);

        $this->clients->each(function($client) use ($from, $message) {
            if ($client !== $from) {
                $client->send($message);
            }
        });
    }

    public function onClose(ConnectionInterface $client)
    {
        $this->clients->remove($client);
    }

    public function onError(ConnectionInterface $connection, Exception $e)
    {
        $connection->close();
    }

}
